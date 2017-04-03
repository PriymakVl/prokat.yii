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
    public $list_id;

    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название списка'],
            [['name'], 'string', 'min' => 5, 'max' => 30],
            ['type', 'default', 'value' => ''],
            ['description', 'default', 'value' => ''],
        ];
    }
    
    public function save($list)
    {   
        if (!$list) $list = new Lists();
        $list->name = $this->name;
        $list->description = $this->description;
        $list->type = $this->type;
        $res = $list->save(); 
        if (!$res) return false;
        $this->list_id = $list->id;
        return true;         
    }
    
    public function getTypes()
    {
        $this->types = Tag::get('list');
        return $this;
    }



}

