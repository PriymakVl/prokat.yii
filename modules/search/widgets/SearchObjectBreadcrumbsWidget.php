<?php

namespace app\modules\search\widgets;

use Yii;
use yii\base\Widget;
use app\modules\objects\models\Objects;
use app\models\Tag;

class SearchObjectBreadcrumbsWidget extends Widget 
{
    public $object;
    public $number;

    public function run()
    {
        $breadcrumbs = $this->getBreadcrumbs();
        return $this->render('object_breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'object' => $this->object, 'number' => $this->number]);
    }
    
     private function getBreadcrumbs()
    {
        $equipment = Tag::find()->where(['alias' => $this->object->equipment, 'type' => 'equipment'])->one();
        $breadcrumbs = ''; 
        $parents = $this->getArrayParents();
        $parents = array_reverse($parents);

        foreach ($parents as $parent) {
            $breadcrumbs .= '<a href="/object?obj_id='.$parent->id.'" class="search-breadcrumbs-link">'.$parent->alias.'</a>';
            $breadcrumbs .= '<span class="glyphicon glyphicon-chevron-right search-breadcrumbs-chevron"></span>';
        } 
        return $breadcrumbs.'<a href="/object?obj_id='.$this->object->id.'" class="search-breadcrumbs-link">'.$this->object->alias.'</a>';   
    }

    private function getArrayParents()
    {
        $parents = [];
        if ($this->object->parent_id) $obj = Objects::findOne(['id' => $this->object->parent_id]);
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

