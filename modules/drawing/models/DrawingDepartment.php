<?php

namespace app\modules\drawing\models;

use yii\data\Pagination;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartment extends BaseModel
{
    public $catName = 'Цех';
    public $category = 'department';
    public $objects;

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
    
    public static function getList($params, $pages_size = self::PAGE_SIZE)
    {
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $pages_size]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all();
        return self::executeMethods($list, []);
    }

//    public function getNumber()
//    {
//        if ((int)($this->number)) {
//            $year = date('y', $this->date ? $this->date : time());
//            $this->number = '27.'.$year.'.'.$this->number;
//        }
//        return $this;
//    }

    public function convertService()
    {  
        $this->service = $this->convertTag('service', $this->service);
        return $this;
    }
    
    public static function getAllForObject($obj)
    {
        $drawings = self::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        if ($drawings) return self::executeMethods($drawings, []);
        else return null; 
    }
    

}





