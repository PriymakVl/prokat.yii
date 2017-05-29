<?php

namespace app\modules\applications\widgets;

use yii\base\Widget;

class AppFormTabWidget extends Widget 
{
    public $nameTab;
    public $form;
    public $f;
    public $app;
    public $item;
    public $object;

    public function run()
    {
        $template = $this->getTemplate();
        return $this->render($template, ['form' => $this->form, 'f' => $this->f, 'app' => $this->app]);
    }
    
    private function getTemplate()
    {
        switch($this->nameTab)
        {
            case 'main': return 'app_form_main'; break;
            case 'other': return 'app_form_other'; break;
            case 'document': return 'app_form_doc'; break;
            //case 'main_content': return 'content_form_main'; break;
//            case 'other_content': return 'content_form_other'; break;
//            case 'object_content': return 'content_form_object'; break;
        }
    }

}

