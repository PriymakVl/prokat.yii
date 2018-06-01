<?php

namespace app\modules\lists\forms;

use app\forms\BaseForm;
use app\modules\lists\models\Lists;
use app\models\Tag;

class ListForm extends BaseForm
{   
    public $name;
    public $type;
    public $description;
    //form
    public $types;
    public $list;

    public function __construct($list)
    {
        if ($list) $this->list = $list;
        else $this->list = new Lists;
    }

    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название списка'],
            [['name'], 'string', 'min' => 5, 'max' => 30],
            ['type', 'default', 'value' => ''],
            ['description', 'default', 'value' => ''],
        ];
    }
    
    public function save()
    {
        $this->list->name = $this->name;
        $this->list->description = $this->description;
        //$this->list->type = $this->type;
        return $this->list->save();
    }
    
    public function getTypes()
    {
        $this->types = Tag::get('list');
        return $this;
    }



}

