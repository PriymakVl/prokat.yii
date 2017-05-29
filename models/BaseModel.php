<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\classes\interfaces\ConfigApp; 
use app\classes\traits\CommonStaticMethods;
use app\models\Tag;

class BaseModel extends ActiveRecord implements ConfigApp
{
    public $cutNote;
    public static $pages;
    
    use CommonStaticMethods;
    
    public static function getOne($id, $default, $status)
    {
        $obj = self::findOne(['id' => $id, 'status' => $status]);
        if ($obj) return $obj;
        else if ($default === false) throw new ForbiddenHttpException('error '.__METHOD__);
        else if ($default === null) return $default;
        else throw new ForbiddenHttpException('error '.$default);; 
    }
    
    public static function getAll()
    {
        return self::findAll(['status' => self::STATUS_ACTIVE]);
    }
    
    public static function getMain()
    {
        return self::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => 0]);    
    }
    
    public static function getList($params = [], $page_size)
    {
        $query = self::find()->where($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $page_size]);
        return $query->offset(self::$pages->offset)->limit(self::$pages->limit)->all();    
    }
    
    public function deleteOne()
    {
        $this->status = self::STATUS_INACTIVE;
        return $this->save();
    }
    
    public function getCodeWithoutVariant($code)
    {
        if (!$code) return false;
        else if (!strpos($code, '/')) return $code;
        else return explode('/', $code)[0];       
    }
    
    public function getAlias($length = 15, $suffix = '')
    {
        if (!$this->alias) {
            $alias = StringHelper::truncate($this->name, $length, $suffix);
            $this->alias = mb_strtolower($alias, 'utf-8');
        } 
        return $this;
    }
    
    public static function  changeParent($objects, $parent_id)
    {
        foreach ($objects as $obj) {
            $obj->parent_id = $parent_id;
            $$obj->save();
        }     
    }
    
     public function getFullCustomer()
    {
        if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getFullName(Employee::getOne($this->customer));
        return $this;
    }
    
    public function getShortCustomer()
    {
        if ((int)$this->customer === 0) $this->customer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName(Employee::getOne($this->customer));
        return $this;
    }
    
    public function getCustomerForPrint()
    {
        if ((int)$this->customer === 0) $this->customer = 'Не указан';
        else if ((int)$this->customer) $this->customer = EmployeeLogic::getShortName(Employee::getOne($this->customer));
        return $this;  
    }
    
    public function getFullIssuer()
    {
        if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->issuer) $this->issuer = EmployeeLogic::getFullName(Employee::getOne($this->issuer));
        return $this;
    }
    
    public function getShortIssuer()
    {
        if ((int)$this->issuer === 0) $this->issuer = '<span style="color:red;">Не указан</span>';
        else if ((int)$this->customer) $this->issuer = EmployeeLogic::getShortName(Employee::getOne($this->issuer));
        return $this;
    }
    
//    public function getTagObjects($key)
//    {
//        return Tag::getObjects($key);
//    }
    
}





