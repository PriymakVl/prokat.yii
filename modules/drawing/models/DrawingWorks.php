<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\logic\DrawingLogic;

class DrawingWorks extends BaseModel
{
    public $child;
    public $parent;
    public $category = 'works';
    public $catName = 'ПКО';
    public $typeName;
    
    const PAGE_SIZE = 30;
 
    
    public static function tableName()
    {
        return 'drawings_works';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    public function checkChild()
    {
        $child = self::findOne(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
        if ($child) $this->child = true;
        return $this;    
    }
    
    public static function getListWorks($params)
    {       
        $list = parent::getList($params, self::PAGE_SIZE);
        return self::executeMethods($list, ['checkChild']);
    }
    
    public function getFiles()
    {
        return $this->hasMany(DrawingWorksFile::className(), ['dwg_id' => 'id'])->where(['status' => self::STATUS_ACTIVE])->orderBy('sheet');    
    }
    
    public function getParent()
    {
        $this->parent = parent::findOne(['status' => self::STATUS_ACTIVE, 'id' => $this->parent_id]);
        return $this;
    }
    
    public function getTypeName()
    {
        switch ($this->type) {
            case 'drawing': $this->typeName = 'Чертеж'; break;
            case 'folder': $this->typeName = 'Папка'; break;
            case 'assembly': $this->typeName = 'Сборочный чертеж'; break;
            case 'specification': $this->typeName = 'Спецификация'; break;
        }
        return $this;
    }
    
    public static function getAllForObject($obj)
    {
        if ($obj->code) $drawings = self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        else $drawings = self::findAll(['obj_id' => $obj->id, 'status' => self::STATUS_ACTIVE]); 
        if (empty($drawings)) return [];
        $drawings = DrawingLogic::cutNotes($drawings);
        return DrawingLogic::getFiles($drawings);   
    }
    
    public static function check($obj)
    {
        if ($obj->code) $dwg = self::findOne(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        else $dwg = self::findOne(['obj_id' => $obj->id, 'status' => self::STATUS_ACTIVE]); 
        return $dwg;    
    }
    
    public static function getSpecification($parent_id)
    {
        $specification = DrawingWorks::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->orderBy('item')->all();
        return self::executeMethods($specification, ['checkChild']);
    }

}





