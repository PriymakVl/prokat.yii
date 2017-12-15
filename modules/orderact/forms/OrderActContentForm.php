<?php

namespace app\modules\orderact\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderActContent;

class OrderActContentForm extends BaseForm
{   
    public $name;
    public $drawing;
    public $code;
    public $count;
    public $weight;
    public $note;
    public $item_id;
    public $order_id;
    //form
    public $item;
    
    public function __construct($item)
    {
        $this->item = $item;
    }
    
    public function rules() 
    {
        return [
            ['name', 'required', 'message' => 'Íåîáõîäèìî çàïîëíèòü ïîëå'],
            [['weight', 'note', 'name', 'drawing', 'code'], 'string'],
            [['count', 'item_id', 'order_id'], 'integer'],
        ];

    }
    
    public function behaviors()
    {
    	return ['order-act-content-logic' => ['class' => OrderActLogic::className()]];
    }
    
    public function save() 
    {
        $this->item->name = $this->name;
        $this->item->count = $this->count;
        $this->item->note = $this->note;
        $this->item->drawing = $this->drawing;
        $this->item->code = $this->code;
        $this->item->item_id = $this->item_id;
        $this->item->order_id = $this->order_id;
        $this->item->weight = $this->weight;
        return $this->item->save();   
    }
    
}


