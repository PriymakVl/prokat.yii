<?php

namespace app\modules\lists\forms;

use app\forms\BaseForm;
use app\modules\lists\models\Lists;

class ListContentForm extends BaseForm
{   
    public $rating;
    public $note;
    public $code;
    public $name;
    //form
    public $list;
    public $item;

    public function __construct($item)
    {
        $this->item = $item;
        $this->list = Lists::findOne(['id' => $item->list_id, 'status' => Lists::STATUS_ACTIVE]);
    }


    public function rules() {
        return [
            [['name', 'code'], 'required', 'message' => 'Необходимо заполнить поле'],
            ['rating', 'default', 'value' => ''],
            ['note', 'default', 'value' => ''],
        ];
    }
    
    public function update()
    {   
        $this->item->rating = $this->rating;
        $this->item->name = $this->name;
        $this->item->code = $this->code;
        $this->item->note = $this->note;
        return $this->item->save();
    }
}