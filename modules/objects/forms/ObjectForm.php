<?php

namespace app\modules\objects\forms;

use app\forms\BaseForm;
use app\models\BaseModel;
use app\modules\objects\models\Objects;
use app\models\Tag;

class ObjectForm extends BaseForm
{   
    public $parent_id;
    public $rus;
    public $eng;
    public $alias;
    public $note;
    public $type;
    public $equipment;
    public $weight;
    public $code;
    public $rating;
    public $item; //position object in specification
    //form
    public $types;
    public $equipments;
    
    public function rules() {
        return [
            [['rus'], 'required', 'message' => 'Необходимо указать название объекта'],
            [['type'], 'required', 'message' => 'Необходимо указать  тип объекта'],
            [['equipment'], 'required', 'message' => 'Необходимо указать оборудование объекта'],
            ['alias', 'default', 'value' => ''],
            ['code', 'default', 'value' => ''],
            ['note', 'default', 'value' => ''],
            ['parent_id', 'default', 'value' => 0],
            ['item', 'default', 'value' => 0],
            ['rating', 'default', 'value' => 0],
        ];
    }
    
    public function getTypes()
    {
        $this->types = Tag::get('object');
        return $this;
    }
    
    public function getEquipments()
    {
        $this->equipments = Tag::get('equipment');
        return $this;
    }
    
    public function save($obj)
    {   
        if (!$obj) $obj = new Objects;
        if (!$obj->code) $obj->code = $this->code;
        $obj->parent_id = $this->parent_id;
        $this->setAliasAndRus($obj);
        $obj->note = $this->note;
        $obj->type = $this->type;
        $obj->equipment = $this->equipment;
        $obj->item = $this->item;
        $obj->rating = $this->rating;
        $obj->save(); 
        if (!$obj->code) {
            $obj->code = $obj->id.'-code';
            $obj->save();    
        }  
        return $obj->id;           
    }
    
    private function setAliasAndRus($obj)
    {
        $objects = Objects::findAll(['code' => $obj->code, 'status' => self::STATUS_ACTIVE]);
        foreach ($objects as $object) {
            $object->alias = $this->alias;
            $object->rus = $this->rus;
            $object->save();
        }      
    }

}