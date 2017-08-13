<?php

namespace app\modules\order\forms;

use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\OrderContent;
use app\modules\objects\models\Objects;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;

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
    public $variant;
    public $delivery;
    public $dimensions;
    //form
    public $item_id;
    public $type_dimensions;
    public $nut_thread; public $nut_pitch;
    public $bolt_thread; public $bolt_pitch; public $bolt_length;
    public $shaft_length; public $shaft_diam;
    public $bush_height; public $bush_in_diam; public $bush_out_diam;
    public $bar_height; public $bar_width; public $bar_length;

    
    public function rules() 
    {
        return [
            [['type_dimensions', 'cat_dwg', 'equipment', 'code', ], 'string'],
            [['note', 'material', 'variant', 'file', 'weight', 'drawing', 'name'], 'string'],
            [['order_id', 'nut_thread', 'nut_pitch', 'bolt_thread', 'bolt_pitch', 'bolt_length',], 'integer'],
            [['shaft_length', 'shaft_diam', 'bush_height', 'bush_in_diam', 'bush_out_diam'], 'integer'],
            [['bar_length', 'bar_height', 'bar_width'], 'integer'],
            [['count', 'item', 'rating', 'obj_id', 'delivery',], 'default', 'value' => 0],
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

        $item->name = $this->name;
        $item->drawing = $this->drawing;   
		$item->weight = $this->weight;
        $item->sheet = $this->sheet;     
        $item->note = $this->note;
        $item->count = $this->count;
        $item->rating = $this->rating;
        $item->order_id = $this->order_id; 
        $item->material = $this->material;
        $item->item = $this->item;
        if ($this->type_dimensions) $item->dimensions = $this->setDimensions();
        //drawing
        $item->cat_dwg = $this->cat_dwg;
        $item->file = $this->file;
        $item->delivery = $this->delivery;
        $item->variant = $this->variant;
        //if ($item->code || $item->obj_id) $this->saveParamsForObjects($item);
        $item->save();
        
        $this->item_id = $item->id;
        return true;
    }
  
    private function saveParamsForObjects($item)
    {
        if (!$item->code) $item->code = Objects::find()->select('code')->where(['id' => $item->obj_id])->column()[0]; 
        $objects = Objects::findAll(['code' => $item->code, 'status' => Objects::STATUS_ACTIVE]);
        foreach ($objects as $obj) {
            if ($item->name) {
                if ($obj->id == $obj_id) $obj->order_name = $item->name;
                else if (!$obj->order_name) $obj->order_name = $item->name;    
            }
            if ($item->dimensions) $obj->dimensions = $item->dimensions;
            $obj->save();
        }  
    }
    
    private function setDimensions()
    {
        $dimensions['type'] = $this->type_dimensions;
 
        if ($this->type_dimensions == 'nut') {
            $dimensions['thread'] = $this->nut_thread;
            $dimensions['pitch'] = $this->nut_pitch;    
        }
        else if ($this->type_dimensions == 'bolt') {
            $dimensions['thread'] = $this->bolt_thread;
            $dimensions['pitch'] = $this->bolt_pitch; 
            $dimensions['length'] = $this->bolt_length;   
        }
        else if ($this->type_dimensions == 'shaft') {
            $dimensions['diam'] = $this->shaft_diam; 
            $dimensions['length'] = $this->shaft_length;   
        }
        else if ($this->type_dimensions == 'bush') {
            $dimensions['in_diam'] = $this->bush_in_diam;
            $dimensions['out_diam'] = $this->bush_out_diam; 
            $dimensions['height'] = $this->bush_height;   
        }
        else if ($this->type_dimensions == 'bar') {
            $dimensions['height'] = $this->bar_height; 
            $dimensions['length'] = $this->bar_length;   
            $dimensions['width'] = $this->bar_width;   
        }
        return serialize($dimensions);
    }

//    private function getObject() 
//    {
//        $obj = null;
//        if ($this->obj_id) $obj = Objects::getOne($obj_id);
//        else if ($this->drawing) $obj = Objects::findOne(['code' => $this->drawing, 'status' => self::STATUS_ACTIVE]); 
//        if ($obj) $obj->getName();  
//        return $obj; 
//    }



}

