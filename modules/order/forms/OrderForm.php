<?php

namespace app\modules\order\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\order\logic\OrderLogic;
use app\modules\order\models\Order;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\models\EquipmentGroup;

class OrderForm extends BaseForm
{   
    const STATUS_DRAFT = 2;
    
    public $name;
    public $issuer;
    public $customer;
    public $number;
    public $date;
    public $weight;
    public $service;
    public $type;
    public $note;
    public $work;
    public $description;
    public $state;
    public $section;
    public $equipment;
    public $unit;
    public $unit_blank;
    public $equipment_blank;
    public $inventory; //inventory number
    public $kind;
    public $group;
    public $subgroup;
    public $unit_subgroup;
    //form
    public $order;
    public $newNumber;
    //form sections of equipments
    public $sections;
    public $equipments;
    public $units;
    //form groups of equipments
    public $groups;
    public $subgroups;
    public $unitsSubgroup;

    
    public function __construct($order) 
    {
        parent::__construct();
        if (is_object($order)) $this->order = $order; 
        else $this->order = new Order();   
    }
    
    public function rules() 
    {
        return [
            [['name', 'type', 'description'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['name', 'note', 'issuer', 'customer', 'work', 'weight', 'service', 'description'],  'string'],
            [['unit', 'equipment', 'inventory', 'kind', 'equipment_blank', 'unit_blank', 'group', 'subgroup', 'unit_subgroup'], 'string'],
            [['section', 'state'], 'integer'],
            ['number','checkNumber'],
            [['date'],'date', 'format' => 'php:d.m.y', 'message' => 'Неправильный формат даты'],
        ];

    }
    
    
    
    public function behaviors()
    {
    	return ['order-logic' => ['class' => OrderLogic::className()]];
    }
    
    public function save() 
    {
        $this->order->type = $this->type;
        $this->order->kind = $this->kind;
        $this->order->name = $this->name;
        $this->order->issuer = $this->getIssuer();
        $this->order->customer = $this->getCustomer();
        $this->order->note = $this->note;
        $this->order->inventory = $this->inventory;
        $this->order->service = $this->service;
        $this->order->date = strtotime($this->prepareDateForConvert($this->date));

        $this->order->work = $this->setWork();
        $this->order->weight = $this->weight;
        
        $this->order->section = $this->section;
        $this->order->equipment = $this->getIdEquipment();
        $this->order->unit = $this->getIdUnit();
        $this->order->equ_blank = $this->equipment_blank;
        $this->order->unit_blank = $this->unit_blank;

        $this->order->group = $this->group;
        $this->order->subgroup = $this->subgroup;
        $this->order->unit_subgroup = $this->unitSubgroup;
        
        $this->order->description = $this->description;
        $this->order->number = $this->number;
        $this->order->state = $this->number ? $this->state : Order::STATE_DRAFT;
        $this->order->period = OrderLogic::getPeriod($this->order->date);
        OrderLogic::deleteNumberFromWhiteList($this->number);
        return $this->order->save();
    }
    
    public function getSections()
    {
        $this->sections = Equipment::getSections();
        return $this;
    }
    
    public function getEquipments()  
    {
        if ($this->order->section) $this->equipments = Equipment::getEquipments($this->order->section);
        return $this;
    }
    
    public function getUnits()
    {
        if ($this->order->equipment) $this->units = Equipment::getUnits($this->order->equipment);
        return $this; 
    }
    
    private function getIdEquipment()
    {
        if (!$this->equipment) return null;
        $equipment = Equipment::find()->where(['name' => $this->equipment, 'parent_id' => $this->section])->one();
        if ($equipment) {
            if ($this->inventory) $equipment->inventory = $this->inventory;
            $equipment->save();
        }
        else {
            $equipment = new Equipment();
            $equipment->name = $this->equipment;
            $equipment->alias = $this->equipment;
            $equipment->parent_id = $this->section;
            $equipment->inventory = $this->inventory;
            $equipment->save();    
        }
        return $equipment->id;
    }
    
    private function getIdUnit()
    {
        if (!$this->unit || !$this->order->equipment) return null;
        $result = Equipment::find()->select('id')->where(['name' => $this->unit, 'parent_id' => $this->order->equipment])->column();
        if ($result) return $result[0];
        $object = new Equipment();
        $object->name = $this->unit;
        $object->alias = $this->unit;
        $object->parent_id = $this->order->equipment;
        $object->save();
        return $object->id;
    }
    
    public function setWork()
    {
        if (!$this->work) return false;
        $pattern = '#<li>(.+?)<\\/li>#is';//get value betwen tags li
        preg_match_all($pattern, $this->work, $matches);
        if (empty($matches[1])) return false;
        else return serialize($matches[1]);
    }
    
    public function checkNumber($attribute, $params, $validator)
    {
        if (!preg_match('/[1-90-90-9]/', $this->number)) {
            $this->addError($attribute, 'Неверный формат номера заказа, пример 150');
        }
    }

    private function getCustomer()
    {
        switch($this->customer) {
            case 'Костырко В.Н.': return '1';
            case 'Саенко А.И.': return '2';
            case 'Волковский С.В.': return '4';
            case 'Станиславский О.В.': return '7';
            case 'Коваль А.П.': return '8';
            case 'Пасюк В.В.': return '9';
            case 'Лисецкий В.Р.': return '10';
            default: return $this->customer;
        }
    }

    private function getIssuer()
    {
        switch($this->issuer) {
            case 'Приймак В.Н.': return '5';
            case 'Немер А.Г.': return '6';
            case 'Битюкова О.В': return '3';
            default: return $this->issuer;
        }
    }
    
    public function getNumberOfFutureOrder()
    {
        $this->newNumber = OrderLogic::getNumberOfFutureOrder();
        return $this;
    }
    
    public function getNameEquipment()
    {
        if ($this->order->equipment) $result = Equipment::findOne(['id' => $this->order->equipment, 'status' => Equipment::STATUS_ACTIVE]);
        if ($result) $this->equipment = $result->name;
        return $this;
    }
    
    public function getNameUnit()
    {
        if ($this->order->unit) $result = Equipment::findOne(['id' => $this->order->unit, 'status' => Equipment::STATUS_ACTIVE]);
        if ($result) $this->unit = $result->name;
        return $this;
    }

    public function getGroups()
    {
        $this->groups = EquipmentGroup::getGroups();
        return $this;
    }

    public function getSubgroups()
    {
        if ($this->order->group) $this->subgroups = EquipmentGroup::getSubgroups($this->order->group);
        return $this;
    }

    public function getUnitsSubgroup()
    {
        if ($this->order->subgroup) $this->unitsSubgroup = EquipmentGroup::getUnitsSubgroup($this->order->subgroup);
        return $this;
    }

      
}


