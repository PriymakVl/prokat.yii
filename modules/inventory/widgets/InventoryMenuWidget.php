<?php

namespace app\modules\inventory\widgets;

use Yii;
use yii\base\Widget;

class InventoryMenuWidget extends Widget 
{
    
    public $inv;
    
    public function run()
    {
        return $this->render('inventory', ['inv' => $this->inv]);
    }

}

