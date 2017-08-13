<?php

namespace app\modules\orderlist\widgets;

use Yii;
use yii\base\Widget;

class OrderListListMenuWidget extends Widget 
{
    
    public function run()
    {
        return $this->render('list_list');
    }

}

