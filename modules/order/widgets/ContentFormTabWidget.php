<?php

namespace app\modules\order\widgets;

use yii\base\Widget;
use app\modules\drawing\logic\DrawingLogic;

class ContentFormTabWidget extends Widget 
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
        $new_draft = DrawingLogic::getNewNumberDepartmentDwg();
        return $this->render($template, ['new_draft' => $new_draft, 'form' => $this->form, 'f' => $this->f, 'order' => $this->order, 'item' => $this->item, 'object' => $this->object]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'content_form_main'; break;
            case 'other': return 'content_form_other'; break;
            case 'dimensions': return 'content_form_dimensions'; break;
        }
    }

}

