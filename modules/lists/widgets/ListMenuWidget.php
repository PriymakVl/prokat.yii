<?php

namespace app\modules\lists\widgets;

use Yii;
use yii\base\Widget;
use app\models\Teg;

class ListMenuWidget extends Widget 
{
    public $list_id;
    
    public function run()
    {
        $action = Yii::$app->controller->action->id;
        return $this->render('list', ['action' => $action, 'list_id' => $this->list_id]);
    }

}

