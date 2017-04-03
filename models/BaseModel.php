<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;
use app\classes\interfaces\ConfigApp; 
use app\classes\traits\CommonStaticMethods;

class BaseModel extends ActiveRecord implements ConfigApp
{
    public $cutNote;
    public static $pages;
    
    use CommonStaticMethods;
    
    public static function getOne($id, $default = false, $status = self::STATUS_ACTIVE)
    {
        $obj = self::findOne(['id' => $id, 'status' => $status]);
        if ($obj) return $obj;
        else if ($default === false) throw new ForbiddenHttpException('error '.__METHOD__);
        else return $default; 
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

}





