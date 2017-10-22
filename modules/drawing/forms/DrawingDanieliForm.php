<?php

namespace app\modules\drawing\forms;

use app\forms\BaseForm;
use yii\web\UploadedFile;
use app\modules\drawing\models\DrawingDanieli;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDanieliForm extends DrawingForm
{   
    public $sheet;
    public $sheets;
    public $revision;
    public $dwg;
    
    public function __construct($dwg)
    {
        $this->dwg = $dwg;
    }
    
    public function behaviors()
    {
    	return ['drawing-logic' => ['class' => DrawingLogic::className()]];
    }

    
    public function rules() 
    {
        return [
            [['sheet', 'sheets'], 'integer'],
            [['revision', 'note'], 'string']
        ];

    }


    public function save() 
    {
        $this->dwg->sheet = $this->sheet;
        $this->dwg->sheets = $this->sheets;
        $this->dwg->revision = $this->revision;
        $this->dwg->note = $this->note;
        return $this->dwg->save();
    }
     

}

