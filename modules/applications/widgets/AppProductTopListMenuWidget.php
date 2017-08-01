<?php

namespace app\modules\applications\widgets;

use Yii;
use yii\base\Widget;
use app\models\Tag;

class AppProductTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        $categories = Tag::getObjects('application');
        return $this->render('top_product_list', ['params' => $this->params, 'categories' => $categories]);
    }

}

