<?php

namespace app\modules\applications\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\applications\logic\ApplicationLogic;
use app\modules\applications\models\Application;
use app\modules\Tag;


class ApplicationForm extends BaseForm
{   
    
    public $title;
    public $issuer;
    public $customer;
    public $executor;
    public $ens;
    public $out;
    public $year;
    public $category;
    //public $service;
    public $type;
    public $period;
    public $department;
    public $note;
    public $type_repair;
    public $state;
    //form
    public $app_id;
    
    public function rules() 
    {
        return [
            [['title', 'department'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['issuer', 'string'],
            ['customer', 'string'],
            ['category', 'string'],
            //['service', 'string'],
            ['note', 'string',],
            ['ens','integer'],
            ['out','integer'],
            ['year','integer'],
            ['state','integer'],
            ['type_repair','string'],
            ['department','string'],
            ['period', 'string'],
        ];

    }
    
    public function behaviors()
    {
    	return ['application-logic' => ['class' => ApplicationLogic::className()]];
    }


    public function save($app) 
    {
        if (!$app) $app = new Application();
        $app = $this->updateData($app);
        debug($this);
        debug($app);
        if (!$app->save()) return false;
        $this->app_id = $app->id;
        return true;  
    }
    
    private function updateData($app)
    {
        $app->department = $this->department;
        $app->title = $this->title;
        $app->customer = $this->customer;
        $app->executor = $this->executor;
        $app->year = $this->year;
        $app->type_repair = $this->type_repair;
        $app->period = $this->period;
        $app->note = $this->note;
        $app->service = 'mech';
        if (!$app->date) $app->date = time();
        return $app;
    }
    
    public function getCategories()
    {
        $this->categories = $this->getTagObjects('application');
    }

}

