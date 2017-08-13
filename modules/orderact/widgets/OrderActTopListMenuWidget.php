<?php

namespace app\modules\orderact\widgets;

use Yii;
use yii\base\Widget;

class OrderActTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        return $this->render('top_list', ['params' => $this->params]);
    }

}

