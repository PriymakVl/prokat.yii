<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;
use app\models\Tag;

class AppTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        $categories = Tag::getObjects('application');
        return $this->render('top_list', ['params' => $this->params, 'categories' => $categories]);
    }

}

