<?php

namespace app\modules\inventory\forms;

use Yii;
use app\forms\BaseForm;
use app\modules\inventory\logic\InventoryLogic;
use app\modules\inventory\models\Inventory;

class InventoryForm extends BaseForm
{   
    
    public $number;
    public $name;
    public $category;
    public $rating;
    public $note;
    public $obj_id;
    
    public $inv;
    public $categories;
    
    public function __construct($inv) 
    {
        if (is_object($inv)) $this->inv = $inv; 
        else $this->inv = new Inventory();   
    }
    
    public function rules() 
    {
        return [
            [['number'], 'required', 'message' => 'Необходимо заполнить поле'],
            [['name', 'number', 'category', 'note'],  'string'],
            [['rating', 'obj_id'],  'integer'],
        ];

    }
    
    
    
    public function behaviors()
    {
    	return ['inventory-logic' => ['class' => InventoryLogic::className()]];
    }
    
    public function save() 
    {
        $this->inv->number = $this->number;
        $this->inv->name = $this->name;
        $this->inv->category = $this->category;
        $this->inv->note = $this->note;
        $this->inv->rating = $this->rating;
        $this->inv->obj_id = $this->obj_id;
        return $this->inv->save();   
    }
    
    public function getCategories()
    {
        $this->categories = ['all' => 'Все', 'mill' => 'Стан', 'stand' => 'Клети', 'sort' => 'Сортовая', 'bunt' => 'Бунтовая',
            'gydro' => 'Гидравлика', 'grease' => 'Смазка', 'finish' => 'Отделка', 'crane' => 'Краны',
            'talie' => 'Тали', 'sundbirsta' => 'Sundbirsta', 'loop' => 'Петлеобразователи', 'cart' => 'Тележки',
            'stock' => 'Склад заготовок', 'without' => 'Без категории', 'pinch-roll' => 'Трайб-аппараты', 'shear' => 'Ножницы',
            'sliting' => 'Слитинг', 'building' => 'Здания',
            ];
        return $this;
    }
    
    
}


