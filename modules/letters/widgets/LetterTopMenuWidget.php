<?php

namespace app\modules\letters\widgets;

use Yii;
use yii\base\Widget;

class LetterTopMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('top_letter');
    }

}

