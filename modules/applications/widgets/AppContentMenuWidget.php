<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;

class AppContentMenuWidget extends Widget 
{
    public $item_id;
    public $app_id;

    public function run()
    {
        return $this->render('content_app_menu', ['item_id' => $this->item_id, 'app_id' => $this->app_id]);
    }

}

