<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectSelectMaterialWidget extends Widget 
{
    public $template;

    public function run()
    {  
        return $this->render($this->template == 'material' ? 'object/select_material' : 'object/select_analog');
    }
    


}

