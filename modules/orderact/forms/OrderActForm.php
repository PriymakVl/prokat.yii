<?php

namespace app\modules\orderact\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;

class OrderActForm extends BaseForm
{   
    public $number;
    public $date_registr;
    public $date_pass;
    public $cost;
    public $working_hour;
    public $order_id;
    public $order_num;
    public $note;
    public $department;
    public $month;
    public $year;
    public $state;
    public $type;
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
            [['date_registr'], 'required', 'message' => 'Необходимо указать дату регистрации'],
            [['cost', 'department', 'note', 'order_num'], 'string'],
            [['working_hour', 'state', 'type', 'month', 'year', 'order_id'], 'integer'],
            [['date_registr'],'date', 'format' => 'php:d.m.y', 'message' => 'Неправильный формат даты'],
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
        if ($this->order_id) $this->act->order_id = $this->order_id;
        $this->act->order_num = $this->order_num;
        $this->act->date_registr = strtotime($this->prepareDateForConvert($this->date_registr));
        $this->act->year = $this->year ? $this->year : date('Y', $this->act->date_registr);
        $this->act->month = $this->month ? $this->month : date('m', $this->act->date_registr);
        if ($this->state == OrderAct::STATE_PASSED) $this->date_pass = time();
        $this->act->working_hour = $this->working_hour;
        $this->act->cost = $this->cost;
        $this->act->type = $this->type;
        return $this->act->save();   
    }
    
    public function getMonths()
    {
        $this->months = self::getArrayMonths();
        return $this;
    }
    
}


