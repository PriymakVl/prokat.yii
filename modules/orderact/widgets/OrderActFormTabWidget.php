<?php

namespace app\modules\orderact\widgets;

use yii\base\Widget;

class OrderActFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $act;

    public function run()
    {
        $template = $this->getTemplate();
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'act' => $this->act]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'act_form_main'; break;
            case 'other': return 'act_form_other'; break;
        }
    }

}

