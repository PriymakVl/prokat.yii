<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\logic\DrawingLogic;

class DrawingWorksForm extends BaseForm
{   
    public $name;
    public $designer;
    public $department;
    public $type;
    public $note;
    public $parent_id;
    public $sheets;
    public $number;
    public $item;
    //form
    public $dwg_id;

    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название чертежа'],
            [['number'], 'required', 'message' => 'Необходимо указать номер чертежа'],
            ['type', 'default', 'value' => 'file'],
            ['item', 'default', 'value' => 0],
            ['parent_id', 'default', 'value' => 0],
            ['note', 'default', 'value' => ''],
            ['designer', 'default', 'value' => ''],
            ['department', 'default', 'value' => ''],
        ];

    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    public function save($dwg) 
    {
        if (!$dwg) $dwg = new DrawingWorks();
        $dwg = $this->updateData($dwg);
        if ($dwg->save()) {
            $this->dwg_id = $dwg->id;
            return true;    
        }
        else return false;
          
    }
    
    private function updateData($dwg)
    {
        $dwg->type = $this->type;
        $dwg->item = $this->item;
        $dwg->number = $this->number;
        $dwg->name = $this->name;
        $dwg->designer = $this->designer;
        $dwg->department = $this->department;
        $dwg->parent_id = $this->parent_id;
        $dwg->note = $this->note;
        $dwg->date = time();
        return $dwg;
    }



}

