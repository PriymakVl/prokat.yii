<?php

namespace app\modules\equipments\forms;

use app\forms\BaseForm;
use app\modules\equipments\logic\EquipmentLogic;
use app\modules\equipments\models\EquipmentGroup;
use app\modules\order\logic\EmployeeLogic;
use app\modules\order\models\Employee;

class EquipmentGroupForm extends BaseForm
{   

    
   public $name;
   public $alias;
   public $note;
   public $rating;
   public $parent_id;

   
    public function rules() 
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['note', 'alias', 'name'], 'string'],
            ['rating', 'default', 'value' => 0],
            [['parent_id', 'rating'], 'integer'],
        ];

    }
    
    public function behaviors()
    {
    	return ['equipment-logic' => ['class' => EquipmentLogic::className()]];
    }


    public function save($item)
    {
        if (!$item) $item = new EquipmentGroup();
        $item->name = $this->name;
        $item->alias = $this->alias;
        $item->rating = $this->rating;
        $item->parent_id = $this->parent_id ? $this->parent_id : 0;
        $item->note = $this->note;
        return $item->save();
    }



}

