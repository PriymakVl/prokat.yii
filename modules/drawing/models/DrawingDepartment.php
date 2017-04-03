<?php

namespace app\modules\drawing\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;

class DrawingDepartment extends BaseModel
{
    public $number;
    public $child;
    public $catName = 'Цех';
    public $category = 'department';
    public $sheet = 1;
    public $sheets = 1;
    public $revision = 'нет';
    public $content;//for folder;
    public $services;
    
    const PAGE_SIZE = 8;
    
    public static function tableName()
    {
        return 'drawings_department';
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    public static function getListDepartment($params)
    {
        $list = parent::getList($params, self::PAGE_SIZE);
        return self::executeMethods($list, ['getNumber']);
    }
    
    public function getContentOfFolder()
    {
        $list = DrawingDepartment::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
        $this->content = $this->executeMethodsOfObjects($list, ['getNumber']);  
    }

    public function getNumber()
    {
        $year = substr($this->year, 2);
        $this->number = '27.'.$year.'.'.$this->id;
        return $this;
    }

    public function convertService()
    {  
        $this->service = $this->convertTag('service', $this->service);
        return $this;
    }
    
    public function checkChild()
    {
        $child = parent::findOne(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
        if ($child) $this->child = true;
        return $this;    
    }
    
    public static function getAllForObject($obj)
    {
        if ($obj->code) $drawings = self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        else $drawings = self::findAll(['obj_id' => $obj->id, 'status' => self::STATUS_ACTIVE]);
        return $drawings;   
    }
    
    public static function check($obj)
    {
        if ($obj->code) $dwg = self::findOne(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        else $dwg = self::findOne(['obj_id' => $obj->id, 'status' => self::STATUS_ACTIVE]);
        return $dwg;     
    }
    

}





