<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingDepartmentTopMenuWidget extends Widget 
{
    
    public function run()
    {
        return $this->render('drawing_department_top');
    }

}

