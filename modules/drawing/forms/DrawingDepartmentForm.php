<?php

namespace app\modules\drawing\forms;

use Yii;
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
    public $id;
    public $parent_id;
    public $code;
    public $number;
    public $date;
    public $status;
    public $note;
    public $file;
    public $obj_id;
    public $name;
    public $file_cdw;
    //public $parent_id;
    //form
    public $dwg;
    public $obj;
    public $noteDwg;
    public $designerDepartmentDwg; public $department_draft; public $department_kompas; public $nameDepartmentDwg;
    
    public function _construct($dwg, $obj)
    {
        if ($dwg)  $this->dwg = $dwg;
        if ($obj) $this->obj = $obj;
//        else {
//            $this->obj = new Objects;
//            $this->obj->save();
//            $this->obj->code = $this->obj->id.'_code';
//            $this->obj->rus = 'Эскиз';
//            $this->obj->save();
//            $this->obj->getName();    
//        }
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            //['service', 'default', 'value' => 'mech'],
            [['designerDepartmentDwg', 'noteDwg', 'nameDepartmentDwg'], 'string'],
            ['department_draft', 'file', 'extensions' => ['pdf', 'tif', 'jpg', 'jpeg']],
            ['department_kompas', 'file', 'extensions' => ['cdw'], 'message' => Yii::t('app', 'Только файлы программы Компас')],
            [['obj_id'], 'integer'],
        ];

    }


    public function save() 
    {
        return DrawingDepartment::saveDwg($this, $this->obj, $this->dwg);
    }
     

}

