<?php

namespace app\modules\standard\components;

use yii\base\Widget;

class StandardMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('index');
    }

}

