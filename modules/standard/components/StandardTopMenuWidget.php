<?php

namespace app\modules\standard\components;

use Yii;
use yii\base\Widget;

class StandardTopMenuWidget extends Widget 
{
    public $std_id;

    public function run()
    {
        $page = 'info';
        return $this->render('top_menu', ['std_id' => $this->std_id, 'page' => $page]);
    }

}

