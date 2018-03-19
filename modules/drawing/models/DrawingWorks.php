<?php

namespace app\modules\drawing\models;

use yii\web\UploadedFile;
use app\models\BaseModel;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;
use yii\data\Pagination;

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
        //$list = parent::getList($params, self::PAGE_SIZE);
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $list = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['id' => SORT_DESC])->all();
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
}





