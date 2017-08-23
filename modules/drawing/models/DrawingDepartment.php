<?php

namespace app\modules\drawing\models;

use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\ObjectDrawing;

class DrawingDepartment extends BaseModel
{
    public $fullNumber;
    public $child;
    public $catName = 'Цех';
    public $category = 'department';
    public $sheet = 1;
    public $sheets = 1;
    public $revision = 'нет';
    public $content;//for folder;
    public $services;
    
    const PAGE_SIZE = 30;
    
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
        return self::executeMethods($list, ['getFullNumber']);
    }
    
    public function getContentOfFolder()
    {
        $list = DrawingDepartment::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
        $this->content = $this->executeMethodsOfObjects($list, ['getFullNumber']);  
    }

    public function getFullNumber()
    {
        $year = substr($this->year, 2);
        $this->fullNumber = '27.'.$year.'.'.$this->number;
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
        //$code = $obj->getCodeWithoutVariant($obj->code);
        //$ids = ObjectDrawing::find()->select('dwg_id')->where(['category' => 'department', 'code' => $code, 'status' => self::STATUS_ACTIVE])->column();
        //if ($ids) return self::findAll($ids);
        //return []; 
        //self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);  
    }
    
    public static function check($obj)
    {
        $code = $obj->getCodeWithoutVariant($obj->code);
        $ids = ObjectDrawing::find()->select('dwg_id')->where(['category' => 'department', 'code' => $code, 'status' => self::STATUS_ACTIVE])->column();
        return self::findAll($ids);      
    }
    
    

}





