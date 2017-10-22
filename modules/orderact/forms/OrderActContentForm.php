<?php

namespace app\modules\orderact\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderActContent;

class OrderActContentForm extends BaseForm
{   
    public $count;
    public $weight;
    public $note;
    public $item_id;
    //form
    public $item;
    
    public function __construct($item)
    {
        $this->item = $item;
    }
    
    public function rules() 
    {
        return [
            [['weight', 'note'], 'string'],
            [['count', 'item_id'], 'integer'],
        ];

    }
    
    public function behaviors()
    {
    	return ['order-act-content-logic' => ['class' => OrderActLogic::className()]];
    }
    
    public function save() 
    {
        $this->item->count = $this->count;
        $this->item->note = $this->note;
        $this->item->item_id = $this->item_id;
        $this->item->weight = $this->weight;
        return $this->item->save();   
    }
    
}


