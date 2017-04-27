<?php

namespace app\modules\letters\widgets;

use Yii;
use yii\base\Widget;
use app\modules\employees\models\Employee;

class LetterTopListMenuWidget extends Widget 
{
    public $params;

    public function run()
    {
        return $this->render('top_list_letter', ['params' => $this->params, 'department' => $department]);
    }

}

