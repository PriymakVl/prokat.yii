<?php

namespace app\modules\inventory\widgets;

use Yii;
use yii\base\Widget;

class InventoryTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        return $this->render('top_list_menu', ['params' => $this->params]);
    }

}

