<?php

namespace app\modules\objects\widgets;

use yii\base\Widget;

class ObjectListChildrenWidget extends Widget 
{
    public $children;
    public $color;
	public $type; //type unit standard or unit or category for create link

    public function run()
    {
        $color = $this->color ? $this->color : '#000';
        return $this->render('object_children', ['children' => $this->children, 'color' => $color, 'type' => $this->type]);
    }

}

