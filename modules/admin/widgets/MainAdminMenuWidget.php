<?php

namespace app\components\adminmenu;

use Yii;
use yii\base\Widget;

class MainAdminMenuWidget extends Widget {

    public function run()
    {
        return $this->render('main_admin');
    }

}

