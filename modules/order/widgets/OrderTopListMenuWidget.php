<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\modules\equipments\models\Equipment;

class OrderTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        $area = Equipment::getArea();
        return $this->render('top_list', ['params' => $this->params, 'area' => $area]);
    }

}

