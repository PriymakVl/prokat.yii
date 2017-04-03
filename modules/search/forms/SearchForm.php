<?php

namespace app\models\forms;

use app\models\forms\ModelForm;

class SearchForm extends ModelForm
{
    public $code;
    
    public function rules() {
        return [
            [['code'], 'required', 'message' => 'Поле должно быть заполнено'],
        ];
    }
}