<?php

namespace app\modules\inventory\widgets;

use Yii;
use yii\base\Widget;

class InventoryListMenuWidget extends Widget 
{
    
    public function run()
    {
        return $this->render('inventory_list');
    }

}

