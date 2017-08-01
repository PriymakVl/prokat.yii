<?php

namespace app\modules\applications\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\applications\logic\ApplicationLogic;
use app\modules\applications\models\Application;
use app\models\Tag;


class ApplicationForm extends BaseForm
{   
    
    public $title;
    public $created;
    public $customer;
    public $executor;
    public $ens;
    public $out_num;
    public $out_date;
    public $year;
    public $category;
    //public $service;
    public $type;
    public $period;
    public $department;
    public $note;
    public $state;
    //form
    public $app_id;
    public $categories;
    
    public function rules() 
    {
        return [
            [['title', 'department'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['created', 'string'],
            ['customer', 'string'],
            ['category', 'string'],
            //['service', 'string'],
            ['note', 'string',],
            ['ens','integer'],
            ['out_num','integer'],
            ['out_date','string'],
            ['year','integer'],
            ['state','integer'],
            ['type','string'],
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
        if (!$app->save()) return false;
        $this->app_id = $app->id;
        return true;  
    }
    
    private function updateData($app)
    {
        if ($this->out_num) $app->out_num = $this->out_num;
        if ($this->out_date) $app->out_date = strtotime($this->out_date);
        $app->department = $this->department;
        $app->title = $this->title;
        $app->category = $this->category;
        if ($this->customer) $app->customer = $this->customer;
        if ($this->executor) $app->executor = $this->executor;
        if ($this->created) $app->created = $this->created;
        $app->year = $this->year;
        $app->type = $this->type;
        $app->period = $this->period;
        $app->state = $this->state;
        if ($this->note) $app->note = $this->note;
        $app->service = 'mech';
        if (!$app->date) $app->date = time();
        return $app;
    }
    
    public function getCategories()
    {
        $this->categories = Tag::getObjects('application');
        return $this;
    }

}

