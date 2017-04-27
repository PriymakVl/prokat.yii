<?php

namespace app\modules\letters\widgets;

use yii\base\Widget;

class LetterFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $letter;

    public function run()
    {
        if ($this->nameTab == 'data') $template = 'letter_form_data';
        else $template = 'letter_form_text';
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'letter' => $this->letter]);
    }


}

