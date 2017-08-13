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
	public $qty; //count objects
    public $code;
    public $rating;
    public $item; //position object in specification
    public $order_name;
    //form
    public $types;
    public $equipments;
	public $all_name;
    
    public function rules() {
        return [
            [['rus'], 'required', 'message' => 'Необходимо указать название объекта'],
            [['type'], 'required', 'message' => 'Необходимо указать  тип объекта'],
            [['equipment'], 'required', 'message' => 'Необходимо указать оборудование объекта'],
            ['alias', 'default', 'value' => ''],
            ['code', 'default', 'value' => ''],
			['weight', 'default', 'value' => ''],
			['qty', 'default', 'value' => ''],
            ['note', 'default', 'value' => ''],
            ['parent_id', 'default', 'value' => 0],
            ['item', 'default', 'value' => 0],
            ['rating', 'default', 'value' => 0],
			['all_name', 'string'],
            ['order_name', 'string', 'length' => [2, 20] ],
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
        if (!$obj->code) $obj->code = trim($this->code);
        $obj->parent_id = $this->parent_id;
        $obj->rus = $this->rus;
		if ($this->all_name && $this->rus && $this->code != '') $this->changeNameAllObjects();
        $obj->alias = $this->alias;
        $obj->note = $this->note;
        $obj->type = $this->type;
		$obj->weight = $this->weight;
		$obj->qty = $this->qty;
        $obj->equipment = $this->equipment;
        $obj->item = $this->item;
        $obj->rating = $this->rating;
        $obj->order_name = $this->order_name;
        $obj->save(); 
        if (!$obj->code) {
            $obj->code = $obj->id.'-code';
            $obj->save();    
        }  
        return $obj->id;           
    }
	
	public function changeNameAllObjects() {
		$objects = Objects::findAll(['code' => $this->code, 'status' => self::STATUS_ACTIVE]);
		if (!$objects) return;
		foreach ($objects as $obj) {
			$obj->rus = $this->rus;
			if ($this->alias) $obj->alias = $this->alias;
            if ($this->order_name) $obj->order_name = $this->order_name;
			$obj->save();
		}
	}

}









