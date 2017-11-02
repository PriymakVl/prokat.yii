<?php

namespace app\modules\drawing\models;

use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartment extends BaseModel
{
    public $fullNumber;
    //public $child;
    public $catName = 'Цех';
    public $category = 'department';
    public $obj;
    //public $sheet = 1;
    //public $sheets = 1;
    //public $revision = 'нет';
    //public $content;//for folder;
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
        $query = self::find()->where($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $page_size]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all(); 
        return self::executeMethods($list, ['getFullNumber', 'getObject']);
    }
    
//    public function getContentOfFolder()
//    {
//        $list = DrawingDepartment::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
//        $this->content = $this->executeMethodsOfObjects($list, ['getFullNumber']);  
//    }

    public function getFullNumber()
    {
        $year = date('y', $this->date);
        $this->fullNumber = '27.'.$year.'.'.$this->number;
        return $this;
    }

    public function convertService()
    {  
        $this->service = $this->convertTag('service', $this->service);
        return $this;
    }
    
//    public function checkChild()
//    {
//        $child = parent::findOne(['status' => self::STATUS_ACTIVE, 'parent_id' => $this->id]);
//        if ($child) $this->child = true;
//        return $this;    
//    }
    
    public static function getAllForObject($obj)
    {
        $drawings = self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        if ($drawings) return self::executeMethods($drawings, ['getFullNumber']);
        else return null; 
    }
    
//    public static function check($obj)
//    {
//        $code = $obj->getCodeWithoutVariant($obj->code);
//        $ids = ObjectDrawing::find()->select('dwg_id')->where(['category' => 'department', 'code' => $code, 'status' => self::STATUS_ACTIVE])->column();
//        return self::findAll($ids);      
//    }

    public function getObject()
    {
        $this->obj = Objects::findOne($this->obj_id, null, self::STATUS_ACTIVE);
        if ($this->obj) $this->obj->getName()->getParent();
        return $this;
    }
    
    

}





