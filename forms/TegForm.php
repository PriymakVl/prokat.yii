<?php

namespace app\models\forms;

use app\models\forms\ModelForm;

class TegForm extends ModelForm
{   
    public $name;
    public $value;
    
    public function rules() {
        return [
            [['name'], 'required', 'message' => 'Необходимо указать название типа списка'],
            [['value'], 'required', 'message' => 'Необходимо указать значение типа списка'],
        ];
    }
}