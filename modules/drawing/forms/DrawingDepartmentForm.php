<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartmentForm extends DrawingForm
{   
    //public $name;
    public $designer;
    //public $service;
    //public $type;
    public $note;
    public $file;
    public $obj_id;
    public $name;
    public $file_cdw;
    //public $parent_id;
    //form
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            //['service', 'default', 'value' => 'mech'],
            [['designer', 'note', 'name'], 'string'],
            ['file', 'file', 'extensions' => ['pdf', 'tif', 'jpg']],
            ['file_cdw', 'file', 'extensions' => ['cdw'], 'message' => \Yii::t('app', 'Только файлы программы Компас')],
            [['obj_id'], 'integer'],
        ];

    }


    public function save($dwg) 
    {
        $dwg->designer = $this->designer;
        $dwg->note = $this->note;
        $dwg->obj_id = $this->obj_id;
        $obj = Objects::getOne($this->obj_id, null, self::STATUS_ACTIVE);
        if ($obj) $dwg->code = $obj->code;
        $dwg->date = time();
        $dwg->name = $this->name;
        $file = UploadedFile::getInstance($this, 'file');
        if ($file) $dwg->file = $this->uploadFile($dwg->id, $file, 'department', '_depart');
        $file_cdw = UploadedFile::getInstance($this, 'file_cdw');
        if ($file_cdw) $dwg->file_cdw = $this->uploadFile($dwg->id, $file_cdw, 'department/kompas', '_kompas');
        return $dwg->save();
    }
     

}

