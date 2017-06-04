<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectListSortMenuWidget extends Widget 
{
    public $sort;
    
    public function run()
    {
        return $this->render('menu/object_list_sort', ['sort' => $this->sort]);
    }

}

