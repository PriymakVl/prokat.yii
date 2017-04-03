<?php

namespace app\modules\lists\widgets;

use yii\base\Widget;
use app\models\Tag;

class ListSortMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        $types = Tag::findAll(['status' => Tag::STATUS_ACTIVE, 'type' => 'list']);
        return $this->render('list_sort', ['types' => $types, 'params' => $this->params]);
    }

}

