<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectListTopFiltersWidget extends Widget
{
    public $sort;
    public $obj_id;
    
    public function run()
    {
        return $this->render('menu/object_list_top_filters', ['sort' => $this->sort, 'obj_id' => $this->obj_id]);
    }

}

