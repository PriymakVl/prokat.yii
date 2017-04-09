<?php

namespace app\modules\employees\forms;

use app\forms\BaseForm;
use app\modules\order\logic\EmployeeLogic;
use app\modules\order\models\Employee;

class EmployeeForm extends BaseForm
{   

    
   public $first;
   public $last;
   public $middle;
   public $phone;
   public $number;
   //form
   public $employee_id;
   
    public function rules() 
    {
        return [
            [['first', 'last', 'middle'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['phone','string'],
            ['number', 'integer'],
        ];

    }
    
    public function behaviors()
    {
    	return ['employee-logic' => ['class' => OrderLogic::className()]];
    }


    public function save($employee) 
    {
        if (!$employee) $employee = new Employee();
        $employee = $this->updateData($order);
        if (!$order->save()) return false;
        $this->employee_id = $employee->id;
        return true;  
    }
    
    private function updateData($employee)
    {
        $employee->first = $this->first;
        $employee->last = $this->last;
        $employee->middle = $this->middle;
        $employee->phone = $this->phone;
        $employee->number = $this->number;
        return $employee;
    }



}

