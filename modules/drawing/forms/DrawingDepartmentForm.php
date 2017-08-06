<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\logic\DrawingLogic;
use app\models\Tag;

class DrawingDepartmentForm extends DrawingForm
{   
    public $name;
    public $designer;
    public $service;
    public $type;
    public $note;
    public $file;
    public $file_cdw;
    public $parent_id;
	public $alias;
    //form
    public $dwg_id;
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название чертежа'],
            ['name', 'default', 'value' => ''],
            ['type', 'default', 'value' => 'file'],
            ['parent_id', 'default', 'value' => 0],
            ['service', 'default', 'value' => 'mech'],
            ['note', 'default', 'value' => ''],
            ['designer', 'default', 'value' => ''],
            ['file', 'file', 'extensions' => ['pdf', 'tif', 'jpg']],
            ['file_cdw', 'file', 'extensions' => ['cdw'], 'message' => \Yii::t('app', 'Только файлы программы Компас')],
            ['alias', 'string'],
            ['alias', 'default', 'value' => ''],
        ];

    }


    public function save($dwg) 
    {
        if (!$dwg) $dwg = new DrawingDepartment();
        $dwg = $this->updateData($dwg);
        if (!$dwg->save()) return false;
        $this->dwg_id = $dwg->id;
        $this->file = UploadedFile::getInstance($this, 'file');
        $dwg->file = $this->uploadFile($dwg->id, $this->file, 'department', '_depart');
        //file compas
        $this->file_cdw = UploadedFile::getInstance($this, 'file_cdw');
        $dwg->file_cdw = $this->uploadFile($dwg->id, $this->file_cdw, 'department', '_depart_kompas');
        if ($dwg->file || $dwg->file_cdw) $dwg->save();
        return true;  
    }
    
    private function updateData($dwg)
    {
        $dwg->type = $this->type;
        $dwg->name = $this->name;
		$dwg->alias = $this->alias;
        $dwg->designer = $this->designer;
        $dwg->parent_id = $this->parent_id;
        $dwg->note = $this->note;
        $dwg->service = $this->service;
        $dwg->date = time();
        $dwg->year = date('Y', time());
        return $dwg;
    }
    

}

