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
        if ($this->type == 'standard') $id_box = 'id="standards-box"';
        else if ($this->type == 'unit') $id_box = 'id="units-box"';
        else if ($this->type == 'category') $id_box = 'id="categories-box"';

        $color = $this->color ? $this->color : '#000';
        return $this->render('object/object_children', ['children' => $this->children, 'color' => $color, 'type' => $this->type, 'id_box' => $id_box]);
    }

}

