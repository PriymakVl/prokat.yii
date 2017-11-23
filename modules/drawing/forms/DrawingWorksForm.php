<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingWorksForm extends BaseForm
{   
    //public $name;
//    public $number;
    public $designer;
    public $department;
    public $code;
    public $numberWorksDwg; public $nameWorksDwg; 
    public $dwg;
    public $works_dwg_1, $works_dwg_2, $works_dwg_3;
    public $noteDwg;
    
    public function __construct($dwg)
    {
        if ($dwg) $this->dwg = $dwg;
        else $this->dwg = new DrawingWorks; 
    }

    public function rules() 
    {
        return [
            [['nameWorksDwg', 'designer', 'department', 'noteDwg', 'numberWorksDwg'], 'string'],
            [['works_dwg_1', 'works_dwg_2', 'works_dwg_3'], 'file', 'extensions' => ['tif', 'jpg', 'jpeg', 'pdf']],
        ];

    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }
    
    public function save() 
    {
        if ($this->dwg->obj_id) $obj = Objects::getOne($this->dwg->obj_id, false, Objects::STATUS_ACTIVE);
        else if ($this->code) $obj = Object::findOne(['code'=> $this->code, 'status' => Objects::STATUS_ACTIVE]);
        if (!$obj) $obj = new Objects();
        if (!$obj->name) $obj->rus = 'Не указано';
        if (!$obj->parent_id) $obj->parent_id = 0;
        $obj->save();
        return DrawingWorks::saveDwg($this, $obj, $this->dwg); 
    }



}

