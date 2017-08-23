<?php

namespace app\modules\drawing\widgets;

use yii\base\Widget;

class DrawingFormTabWidget extends Widget 
{
    public $template;
    public $form;
    public $f;
    public $dwg;
    //public $item;
    public $object;

    public function run()
    {
        return $this->render($this->template, ['form' => $this->form, 'f' => $this->f, 'dwg' => $this->dwg, 'object' => $this->object]);
    }
    


}

