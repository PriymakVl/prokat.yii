<?php

namespace app\modules\inventory\models;

use Yii;
use app\models\BaseModel;
use yii\data\Pagination;
use app\modules\objects\models\Objects;
use app\modules\inventory\logic\InventoryLogic;

class Inventory extends BaseModel
{
    public $obj;
    
    const PAGE_SIZE = 25;
    
    public static function tableName()
    {
        return 'inventories';
    }
    
    public function behaviors()
    {
    	return ['inventory-logic' => ['class' => InventoryLogic::className()]];
    }
    
    public static function getListInventory($params)
    {
        $query = self::find()->filterWhere($params);
        self::$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => self::PAGE_SIZE]);
        $inventories = $query->offset(self::$pages->offset)->limit(self::$pages->limit)->orderBy(['number' => SORT_ASC])->all();
        return self::executeMethods($inventories, ['getObject', 'convertCategory']); 
    }
    
    public function getObject()
    {
        if ($this->obj_id) $this->obj = Objects::getOne($this->obj_id, false, self::STATUS_ACTIVE);
        return $this;
    }
    
    public function convertCategory()
    {
        $this->category = InventoryLogic::convertCategory($this->category);
        return $this;
    }
    

}