<?php

namespace app\modules\letters\widgets;

use Yii;
use yii\base\Widget;

class LetterListMenuWidget extends Widget 
{
    public $state;
    
    public function run()
    {
        return $this->render('letter_list_menu', ['state' => $this->state]);
    }

}

