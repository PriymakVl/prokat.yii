<?php

namespace app\modules\order\widgets;

use Yii;
use yii\base\Widget;
use app\models\Tag;

class OrderTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        $tags = Tag::get('order');
       
        return $this->render('top_list', ['params' => $this->params, 'tags' => $tags]);
    }

}

