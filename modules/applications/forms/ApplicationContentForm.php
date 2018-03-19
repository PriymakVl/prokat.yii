<?php

namespace app\modules\order\forms;

use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\OrderContent;
use app\modules\objects\models\Objects;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;

class ApplicationContentForm extends BaseForm
{   
    const STATUS_DRAFT = 2;
    
    public $name;
    public $drawing;
    public $weight;
    public $note;
    public $rating;
    public $item;
    public $count;
    public $material;
    public $order_id;
    public $code;
    public $cat_dwg;
    public $equipment;
    public $file;
    public $sheet;
    //form
    public $item_id;

    
    public function rules() 
    {
        return [
            [['name', 'drawing', 'weight', 'note', 'material', 'code', 'equipment', 'cat_dwg', 'file'], 'string',],
            [['count', 'item', 'rating', 'obj_id'], 'default', 'value' => 0],
            ['order_id', 'integer'],
            ['name', 'default', 'value' => 'деталь'],
            ['sheet', 'default', 'value' => 1],
        ];

    }
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }


    public function save($item)
    {
        if (!$item) $item = new OrderContent();
        $obj = $this->getObject();
        if ($obj) {
			$item = OrderLogic::saveParamsFromObject($obj, $this->order_id);
			if ($this->drawing) $item->drawing = $this->drawing;
			if ($this->weight) $item->weight = $this->weight;
			if ($this->name) $item->name = $this->name;
		}
        else {

            $item->name = $this->name ? $this->name : 'деталь';
            $item->drawing = $this->drawing;  
            $item->cat_dwg = $this->cat_dwg;
            $item->file = $this->file; 
			$item->weight = $this->weight;
            $item->sheet = $this->sheet;
        }
        $item->name = $this->name;
        $item->code = $this->code;
        $item->note = $this->note;
        $item->count = $this->count;
        $item->rating = $this->rating;
        $item->order_id = $this->order_id; 
        $item->material = $this->material;
        if ($this->item || $this->item === '0') $item->item = $this->item;
        $item->save();
        $this->item_id = $item->id;
        return true;
    }

    private function getObject() 
    {
        $obj = null;
        if ($this->obj_id) $obj = Objects::getOne($obj_id);
        else if ($this->drawing) $obj = Objects::findOne(['code' => $this->drawing, 'status' => self::STATUS_ACTIVE]); 
        if ($obj) $obj->getName();  
        return $obj; 
    }



}

