<?php

namespace app\modules\orderlist\widgets;

use yii\base\Widget;

class OrderListFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $list;
    public $order;

    public function run()
    {
        $template = $this->getTemplate();
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'order' => $this->order, 'list' => $this->list]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'form_tab_main'; break;
            case 'other': return 'form_tab_other'; break;
        }
    }

}

