<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class FlashMessageWidget extends Widget 
{

    public function run()
    {
        $messages = ['danger', 'success', 'warning'];
        return $this->render('flash_message', compact('messages'));
    }

}

