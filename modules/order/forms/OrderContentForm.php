<?php

namespace app\modules\order\forms;

use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\OrderContent;

class OrderContentForm extends BaseForm
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
    public $obj_id;
    public $cat_dwg;
    public $equipment;
    public $file;
    public $sheet;
    //form
    public $item_id;

    
    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['drawing', 'string'],
            ['count', 'default', 'value' => 0],
            ['weight', 'string'],
            ['note', 'string',],
            ['item', 'default', 'value' => 0],
            ['material', 'string'],
            ['rating', 'default', 'value' => 0],
            ['order_id', 'integer'],
            ['code', 'string'],
            ['obj_id', 'integer'],
            ['equipment', 'string'],
            ['cat_dwg', 'string'],
            ['file', 'string'],
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
        $order = $this->updateData($item);
        if (!$item->save()) return false;
        $this->item_id = $item->id;
        return true;  
    }
    
    private function updateData($item)
    {
        $item->name = $this->name;
        $item->drawing = $this->drawing;
        $item->item = $this->item;
        $item->note = $this->note;
        $item->count = $this->count;
        $item->weight = $this->weight;
        $item->rating = $this->rating;
        $item->material = $this->material;
        $item->order_id = $this->order_id;
        $item->equipment = $this->equipment;
        $item->cat_dwg = $this->cat_dwg;
        $item->file = $this->file;
        if ($this->obj_id) $item->obj_id = $this->obj_id;
        if ($this->code) $item->code = $this->code;
        $item->sheet = $this->sheet;
        return $item;
    }



}

