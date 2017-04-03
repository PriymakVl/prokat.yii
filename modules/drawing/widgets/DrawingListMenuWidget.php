<?php

namespace app\modules\drawing\widgets;

use yii\base\Widget;

class DrawingListMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('drawing_list');
    }

}

