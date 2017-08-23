<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DepartmentFormTopMenuWidget extends Widget 
{

    public function run()
    {
        return $this->render('department_form_top_menu');
    }

}

