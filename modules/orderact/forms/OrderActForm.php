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
    public $working_hour;
    public $order_id;
    public $note;
    public $department;
    public $month;
    public $state;
    //form
    public $act;
    public $months;
    
    public function __construct($act)
    {
        if ($act) $this->act = $act;
        else $this->act = new OrderAct();
    }
    
    public function rules() 
    {
        return [
            [['number'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['cost', 'string'],
            [['working_hour', 'month', 'state'], 'integer'],
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
    
    public function save() 
    {
        $this->act->number = $this->number;
        $this->act->note = $this->note;
        $this->act->department = $this->department;
        $this->act->state = $this->state;
        //$this->act->date_creat = strtotime($this->prepareDateForConvert($this->date_creat));
        //$this->act->date_regist = $this->date_regist;
        //$this->act->date_pass = $this->date_pass;
        $this->act->working_hour = $this->working_hour;
        $this->act->cost = $this->cost;
        return $this->act->save();   
    }
    
    public function getMonths()
    {
        $this->months = self::getArrayMonths();
        return $this;
    }
    
}


