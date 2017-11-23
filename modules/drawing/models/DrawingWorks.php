<?php

namespace app\modules\drawing\models;

use yii\web\UploadedFile;
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
    
    public function getParent()
    {
        $this->parent = parent::findOne(['status' => self::STATUS_ACTIVE, 'id' => $this->parent_id]);
        return $this;
    }
    
    public static function getAllForObject($obj)
    {
        return self::find()->where(['code' => $obj->code, 'status' => self::STATUS_ACTIVE])->all();
    }
    
    public static function saveDwg($form, $obj, $dwg = null)
    {
        if ($form->numberWorksDwg) $dwg = self::findOne(['number' => $form->numberWorksDwg, 'status' => self::STATUS_ACTIVE]);
        if (!$dwg) $dwg = new DrawingWorks();
        $dwg->obj_id = $obj->id;
        $dwg->code = $obj->code;
        $dwg->parent_id = $obj->parent_id;
        if ($form->noteDwg) $dwg->note = $form->noteDwg; 
        $dwg->date = time();
        $dwg->number = $form->numberWorksDwg ? $form->numberWorksDwg : $obj->code;
        $dwg->name = $form->nameWorksDwg;
        self::uploadSheet($form, $dwg, 1); 
        self::uploadSheet($form, $dwg, 2); 
        self::uploadSheet($form, $dwg, 3);
        $dwg->save();
        return true; 
    }
    
    private static function uploadSheet($form, $dwg, $number) 
    {
        $sheet = UploadedFile::getInstance($form, 'works_dwg_'.$number);
        if (!$sheet) return false;
        $filename = $dwg->id.'_works_'.$number.'.'.$sheet->extension;
        $sheet->saveAs('files/works/'.$filename); 
        if ($number == 1) $dwg->sheet_1 = $filename;   
        else if ($number == 2) $dwg->sheet_2 = $filename;   
        else if ($number == 3) $dwg->sheet_3 = $filename;    
    }
    

}





