<?php

namespace app\modules\letters\widgets;

use yii\base\Widget;

class LetterMenuWidget extends Widget 
{
    public $letter_id;

    public function run()
    {
        return $this->render('letter_menu', ['letter_id' => $this->letter_id]);
    }

}

