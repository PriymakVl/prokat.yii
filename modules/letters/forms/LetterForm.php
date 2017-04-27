<?php

namespace app\modules\letters\forms;

use app\forms\BaseForm;
use app\modules\letters\logic\LetterLogic;
use app\modules\letters\models\Letter;

class LetterForm extends BaseForm
{   

   public $subject;
   //public $toOut;
   public $date;
   public $whom;
   public $text;
   public $executor;
   //form
   public $letter_id;
   public $whom_position;
   public $whom_name;
   public $copy_position_1;
   public $copy_name_1;
   public $copy_position_2;
   public $copy_name_2;
   public $copy_position_3;
   public $copy_name_3;
   
    public function rules() 
    {
        return [
            [['subject',], 'required', 'message' => 'Необходимо заполнить поле'],
            ['date','string'],
            //['toOut', 'string'],
            ['whom_position', 'string'],
            ['whom_name', 'string'],
            ['text', 'string'],
            ['copy_position_1', 'string'],
            ['copy_position_2', 'string'],
            ['copy_position_3', 'string'],
            ['copy_name_1', 'string'],
            ['copy_name_2', 'string'],
            ['copy_name_3', 'string'],
        ];

    }
    
    public function behaviors()
    {
    	return ['letter-logic' => ['class' => LetterLogic::className()]];
    }


    public function save($letter) 
    {
        if (!$letter) $letter = new letter();
        $letter = $this->updateData($letter);
        if (!$letter->save()) return false;
        $this->letter_id = $letter->id;
        return true;  
    }
    
    private function updateData($letter)
    {
        $letter->subject = $this->subject;
        //$letter->toOut = $this->toOut;
        $letter->date = strtotime($this->prepareDateForConvert($this->date));
        $letter->whom = $this->setWhom();
        $letter->copy = $this->setCopy();
        //$letter->from = $this->setFrom();
        //$letter->executor = $this->setExecutor();
        $letter->text = $this->text;
        return $letter;
    }
    
    private function setWhom()
    {
        $whom = [$this->whom_position => $this->whom_name];
        return serialize($whom);
    }
    
    private function setFrom()
    {
        $from = [$this->from_position => $this->from_name];
        return serialize($from);
    }
    
    private function setCopy()
    {
        if (!$this->copy_position_1 && $this->copy_name_1) return false;
        $copy[] = [$this->copy_position_1 => $this->copy_name_1];
        if ($this->copy_position_2 && $this->copy_name_2) $copy[] = [$this->copy_position_2 => $this->copy_name_2];
        if ($this->copy_position_3 && $this->copy_name_3) $copy[] = [$this->copy_position_3 => $this->copy_name_3];
        return serialize($copy);
    }
    
    private function setExecutor()
    {
        $executor = [$this->exe_position, $this->exe_name, $this->exe_phone];
        return serialize($executor);
    }



}

