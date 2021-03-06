<?php

namespace app\modules\equipments\forms;

use app\forms\BaseForm;
use app\modules\equipments\logic\EquipmentLogic;
use app\modules\equipments\models\Equipment;

class EquipmentForm extends BaseForm
{


    public $name;
    public $alias;
    public $note;
    public $rating;
    public $inventory;
    public $parent_id;


    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['note', 'alias', 'name', 'inventory'], 'string'],
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
        if (!$item) $item = new Equipment();
        $item->name = $this->name;
        $item->alias = $this->alias;
        $item->rating = $this->rating;
        $item->parent_id = $this->parent_id ? $this->parent_id : 0;
        $item->inventory = $this->inventory;
        $item->note = $this->note;
        return $item->save();
    }



}

