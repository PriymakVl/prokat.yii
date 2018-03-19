<?php

namespace app\modules\chain\widgets;

use Yii;
use yii\base\Widget;

class ChainMenuWidget extends Widget {

    public function run()
    {
        return $this->render('chain');
    }

}

