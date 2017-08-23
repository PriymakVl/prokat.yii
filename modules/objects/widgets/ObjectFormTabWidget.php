<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectFormTabWidget extends Widget 
{
    public $template;
    public $form;
    public $f;
    public $obj;
    public $parent_id;

    public function run()
    {
        return $this->render($this->template, ['form' => $this->form, 'f' => $this->f, 'obj' => $this->obj, 'parent_id' => $this->parent_id]);
    }
    


}

