<?php

namespace app\modules\applications\widgets;

use yii\base\Widget;

class AppProductListMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('product_list_menu');
    }

}

