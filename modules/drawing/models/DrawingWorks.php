<?php

namespace app\modules\drawing\models;

use app\models\BaseModel;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingWorks extends BaseModel
{
    public $child;
    public $parent;
    public $category = 'works';
    public $catName = 'ПКО';
    public $typeName;
    public $obj;
    //public $sheets = 1;
    
    
    const PAGE_SIZE = 30;
 
    
    public static function tableName()
    {
        return 'drawings_works';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
//    public function checkChild()
//    {
//        $child = self::findOne(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
//        if ($child) $this->child = true;
//        return $this;    
//    }
    
    public static function getListWorks($params)
    {       
        $list = parent::getList($params, self::PAGE_SIZE);
        return self::executeMethods($list, ['getObject', 'getName']);
    }
    
    public function getObject()
    {
        $this->obj = Objects::findOne($this->obj_id, null, self::STATUS_ACTIVE);
        if ($this->obj) $this->obj->getName()->getParent();
        return $this;
    }
    
    public function getName()
    {
        if ($this->name) return $this->name;
        else if ($this->obj) $this->name = $this->obj->name;
        return $this;
    }
    
//    public function getFiles()
//    {
//        return $this->hasMany(DrawingWorksFile::className(), ['dwg_id' => 'id'])->where(['status' => self::STATUS_ACTIVE])->orderBy('sheet');    
//    }
    
    public function getParent()
    {
        $this->parent = parent::findOne(['status' => self::STATUS_ACTIVE, 'id' => $this->parent_id]);
        return $this;
    }
    
//    public function getTypeName()
//    {
//        switch ($this->type) {
//            case 'drawing': $this->typeName = 'Чертеж'; break;
//            case 'folder': $this->typeName = 'Папка'; break;
//            case 'assembly': $this->typeName = 'Сборочный чертеж'; break;
//            case 'specification': $this->typeName = 'Спецификация'; break;
//        }
//        return $this;
//    }
    
    public static function getAllForObject($obj)
    {
        return self::find()->where(['code' => $obj->code, 'status' => self::STATUS_ACTIVE])->all();
    }
    
//    public static function check($obj)
//    {
//        $code = $obj->getCodeWithoutVariant($obj->code);
//        $ids = ObjectDrawing::find()->select('dwg_id')->where(['category' => 'works', 'code' => $code, 'status' => self::STATUS_ACTIVE])->column();
//        return self::findAll($ids);    
//    }
    
//    public static function getSpecification($parent_id)
//    {
//        $specification = DrawingWorks::find()->where(['status' => self::STATUS_ACTIVE, 'parent_id' => $parent_id])->orderBy('item')->all();
//        return self::executeMethods($specification, ['checkChild']);
//    }

}





