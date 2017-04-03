<?php

namespace app\modules\lists\forms;

use app\forms\BaseForm;

class ListContentForm extends BaseForm
{   
    public $rating;
    public $note;
    public $code;
    //form
    public $name;
    
    
    public function rules() {
        return [
            ['rating', 'default', 'value' => ''],
            ['note', 'default', 'value' => ''],
        ];
    }
    
    public function update($item)
    {   
        $item->rating = $this->rating;
        $item->note = $this->note;
        return $item->save();         
    }
}