<?php

namespace app\modules\orderact\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;

class OrderActForm extends BaseForm
{   
    public $number;
    public $date_creat;
    public $date_pass;
    public $cost;
    public $time;
    public $order_id;
    public $note;
    public $department;
    //form
    public $act_id;
    
    public function rules() 
    {
        return [
            [['number'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['cost', 'string'],
            ['time', 'string'],
            ['department', 'string'],
            [['date_creat'],'date', 'format' => 'php:d.m.y', 'message' => 'Неправильный формат даты'],
            [['date_pass'],'date', 'format' => 'php:d.m.y', 'message' => 'Неправильный формат даты'],
            ['note', 'string'],
        ];

    }
    
    
    
    public function behaviors()
    {
    	return ['order-act-logic' => ['class' => OrderActLogic::className()]];
    }
    
    public function save($act) 
    {
        $act = $this->updateData($act);
        if (!$act->save()) return false;
        $this->saveContent($act);
        $this->act_id = $act->id;
        return true;  
    }
    
    private function updateData($act)
    {
        $act->number = $this->number;
        $act->note = $this->note;
        $act->date_creat = strtotime($this->prepareDateForConvert($this->date_creat));
        $act->date_regist = $this->date_regist;
        $act->date_pass = $this->date_pass;
        $act->time = $this->time;
        $act->cost = $this->cost;
        return $act;
    }
    
    private function saveContent($act)
    {
        $content = OrderActContent::findAll(['act_id' => $act->id, 'status' => STATUS_ACTIVE]);
        if (!$content) return false;
        foreach ($content as $item) {
            $item->count = $_POST['count_'.$item->id];
        }
    }
    
}


