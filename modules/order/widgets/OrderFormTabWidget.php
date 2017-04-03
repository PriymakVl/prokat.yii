<?php

namespace app\modules\order\widgets;

use yii\base\Widget;

class OrderFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $order;
    public $item;
    public $object;

    public function run()
    {
        $template = $this->getTemplate();
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'order' => $this->order, 'item' => $this->item, 'object' => $this->object]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'order_form_main'; break;
            case 'other': return 'order_form_other'; break;
            case 'work': return 'order_form_work'; break;
            case 'main_content': return 'content_form_main'; break;
            case 'other_content': return 'content_form_other'; break;
            case 'object_content': return 'content_form_object'; break;
        }
    }

}

