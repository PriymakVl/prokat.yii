<?php

namespace app\modules\drawing\widgets;

use Yii;
use yii\base\Widget;

class DrawingFileMenuWidget extends Widget 
{
    public $dwg_id;


    public function run()
    {
        return $this->render('drawing_files', ['type' => 'works', 'dwg_id' => $this->dwg_id]);
    }

}

