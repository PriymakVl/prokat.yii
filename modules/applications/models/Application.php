<?php

namespace app\modules\applications\models;

use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\models\BaseModel;
use app\modules\applications\logic\ApplicationLogic;
use app\modules\employees\logic\EmployeeLogic;
use app\modules\employees\models\Employee;

class Application extends BaseModel
{
    public $content;
    public $number_out;
    public $number_ens;
    public $categories;
    
    const PAGE_SIZE = 15;
    const STATE_APP_DRAFT = 1;
    const STATE_APP_ACTIVE = 2;
    //const ORDER_STATE_NOT_ACCEPTED = 3;
    //const ORDER_STATE_PART_MANUFACTURED = 4;
    //const ORDER_STATE_MANUFACTURED = 5;
    //const ORDER_STATE_CLOSED = 6;
    
    public static function tableName()
    {
        return 'applications';
    }
    
    public function behaviors()
    {
    	return ['application-logic' => ['class' => ApplicationLogic::className()]];
    }
    
    public function getContent()
    {
        $this->content = OrderContent::findAll(['status' => self::STATUS_ACTIVE, 'app_id' => $this->id]);
    }
    
    public function getOutNumber()
    {
        $this->number_out = 245;
        return $this;
    }
    
    public function getEnsNumber()
    {
        $this->number_ens = $this->ens;
        return $this;
    }
    
    public static function getApplicationList($params)
    {
        $query = self::find()->where($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['ens' => SORT_ASC])->all();
        return self::executeMethods($list, ['getOutNumber', 'getEnsNumber']);
    }
    
    public static function getListForFile($ids)
    {
        $ids = trim($ids);
        $sql = 'SELECT * FROM `orders` WHERE `id` IN('.$ids.')  ORDER BY `number` DESC';
        $list = self::findBySql($sql)->all();
        return self::executeMethods($list, ['getNumber', 'convertServiceForFile', 'convertDateForFile', 'getCustomerForPrint']);
    }
    
    public function convertType()
    {
        $this->type = OrderLogic::convertType($this->type);
        return $this;
    }
    
    public function convertDateForFile()
    {
        return parent::convertDate($this, false, 'd.m.y');
    }
    
    public function convertArea()
    {
        $this->area = ApplicationLogic::convertArea($this->area);
        return $this;
    }
    
    public function convertServiceForFile()
    {
        return parent::convertService($this);
    }
    
    public static function searchByOutNumber($out)
    {
        $ids = OutNumbers::getIdsByNumber($out, 'application');
        $apps = self::findAll($ids);
        if (count($apps) > 1) self::executeMethods($orders, []);
        return $apps;
    }
    
    public static function searchByEnsNumber($ens)
    {
        $apps = self::find()->where(['ens' => $ens, 'status' => self:: STATUS_ACTIVE])->all();
        if (count($apps) > 1) self::executeMethods($apps, []);
        return $apps;
    }
    
//    public function getCategories()
//    {
//        $this->categories = $this->getTagObjects('application');
//        return $this;
//    }

}





