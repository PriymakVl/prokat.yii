<?php

namespace app\modules\orderact\widgets;

use Yii;
use yii\base\Widget;
use app\logic\BaseLogic;

class OrderActTopListMenuWidget extends Widget 
{
    public $params;
    public $acts = true;

    public function run()
    {
        $session = Yii::$app->session;
        $filters = $session->get('act-filters');
        $months = BaseLogic::getArrayMonths();
        $template = $this->acts ? 'top_list_acts' : 'top_list_content'; 
        return $this->render($template, ['params' => $this->params, 'months' => $months, 'filters' => $filters]);
    }

}

