<?php

namespace app\modules\objects\widgets;

use Yii;
use yii\helpers\Url;
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
        if (!$this->obj_id) return $this->render('menu/object_boot_breadcrumbs');
        $this->obj = Objects::findOne($this->obj_id);
        if ($this->obj) $this->obj->getName()->getAlias();
        
        $breadcrumbs = $this->getBreadcrumbs();
        return $this->render('menu/object_boot_breadcrumbs', ['breadcrumbs' => $breadcrumbs]);
    }
    
     private function getBreadcrumbs()
    {
        $equipment = Tag::find()->where(['alias' => $this->obj->equipment, 'type' => 'equipment'])->one();
        $breadcrumbs = '<ul class="nav navbar-nav" id="top-breadcrumbs-link">';
        $breadcrumbs .= '<li>';
        $breadcrumbs .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">Участки</a>';
        $breadcrumbs .= $this->getSubMenuArea();
        $breadcrumbs .= '</li> '; 
        
        $parents = array_reverse($this->getArrayParents());

        foreach ($parents as $parent) {
            $breadcrumbs .= '<li class="dropdown">';
            $breadcrumbs .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$parent->alias.'</a>';
            $breadcrumbs .= '<span class="glyphicon glyphicon-chevron-right top-breadcrumbs-chevron" aria-hidden="true"></span>';
            $breadcrumbs .= $this->getSubMenu($parent);
            $breadcrumbs .= '</li>';
        } 
        return $breadcrumbs.'<li><a href="/object/specification?obj_id='.$this->obj->parent_id.'">'.$this->obj->alias.'</a><span class="glyphicon glyphicon-chevron-right top-breadcrumbs-chevron" aria-hidden="true"></li>';   
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
    
    private function getSubMenu($parent) 
    {
        $submenu = '<ul class="dropdown-menu">';
        $objects = Objects::find()->where(['parent_id' => $parent->id, 'status' => Objects::STATUS_ACTIVE])->orderBy('item', SORT_DESC)->all();
        for ($i = 0; $i < count($objects); $i++) {
            if (!$objects[$i] || $i > 20) break;
            if ($objects[$i]->item > 99 && $objects[$i]->item < 300) continue;
			$objects[$i]->getName()->getAlias();
            $submenu .= '<li>';
            $item = $objects[$i]->item ?  $objects[$i]->item.' ' : '';
            $submenu .= '<a href="/object/specification?obj_id='.$objects[$i]->id.'">'.$item.') '.$objects[$i]->alias.'</a>';
            $submenu .= '</li>';   
        } 
        return $submenu .= '</ul>';  
    }
    
    private function getSubMenuArea() 
    {
        $submenu = '<ul class="dropdown-menu">';
        $objects = Objects::findAll(['parent_id' => 0, 'status' => Objects::STATUS_ACTIVE]);
        for ($i = 0; $i < count($objects); $i++) {
			$objects[$i]->getName()->getAlias();
            $submenu .= '<li>';
            $item = $objects[$i]->item ?  $objects[$i]->item.' ' : '';
            $submenu .= '<a href="/object/specification?obj_id='.$objects[$i]->id.'">'.$item.') '.$objects[$i]->alias.'</a>';
            $submenu .= '</li>';   
        } 
        return $submenu .= '</ul>';  
    }

}

