<?php

namespace app\modules\objects\widgets;

use Yii;
use yii\base\Widget;
use app\modules\objects\models\Objects;
use app\models\Tag;

class ObjectBreadcrumbsHeaderWidget extends Widget 
{
    public $obj;
    public $obj_id;

    public function init()
    {
        $this->obj_id = Yii::$app->request->get('obj_id');
    }

    public function run()
    {
        $this->obj = Objects::findOne($this->obj_id);
        if ($this->obj) $this->obj->getName()->getAlias();
        
        $breadcrumbs = $this->getBreadcrumbs();
        return $this->render('menu/object_breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
    }

    

     private function getBreadcrumbs()
    {
        $equipment = Tag::find()->where(['alias' => $this->obj->equipment, 'type' => 'equipment'])->one();
        $breadcrumbs = '<span class="breadcrumbs-equipment">'.$equipment->name.'</span>'; 
        $parents = $this->getArrayParents();
        $parents = array_reverse($parents);

        foreach ($parents as $parent) {
            $breadcrumbs .= '<a href="/object?obj_id='.$parent->id.'">'.$parent->alias.'</a>';
        } 
        return $breadcrumbs.'<span>'.$this->obj->alias.'</span>';   
    }

    private function getArrayParents()
    {
        $parents = [];
        if ($this->obj->parent_id) $obj = Objects::findOne(['id' => $this->obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        if(!$obj) return $parents;
        $obj->getName()->getAlias();
        $parents[] = $obj;
        $obj = Objects::findOne(['id' => $obj->parent_id]);
        $obj->getName()->getAlias();
        return $parents;
    }

}

