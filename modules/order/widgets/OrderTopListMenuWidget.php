<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;

class OrderTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
       
        return $this->render('top_list', ['params' => $this->params]);
    }

}

