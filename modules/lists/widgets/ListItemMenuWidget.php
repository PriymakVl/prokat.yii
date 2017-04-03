<?php

namespace app\modules\lists\widgets;

use yii\base\Widget;

class ListItemMenuWidget extends Widget {

    public $obj_id;

    public function run()
    {
        return $this->render('list_item', ['obj_id' => $this->obj_id]);
    }

}

