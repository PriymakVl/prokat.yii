<?php

namespace app\modules\objects\logic;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use app\logic\BaseLogic;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDanieli;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\models\DrawingSundbirsta;
use app\modules\drawing\models\DrawingStandardDanieli;
use app\modules\orderact\models\OrderActContent;

class ObjectLogic extends BaseLogic
{
    
    public static function prepareChildren($children)
    {
        foreach ($children as $child) {
            $child->getName()->checkChild();
			if ($child->equipment == 'danieli') {
				if ($child->item === 0) $sort['category'][] = $child;
				else if ($child->item < 300) $sort['standard'][] = $child;
				else $sort['unit'][] = $child; 
			}
			else $sort['unit'][] = $child;
        }
        return $sort;
    }
    
    public static function getDrawings($obj)
    { 
        $drawings['danieli'] = DrawingDanieli::getAllForObject($obj);
        $drawings['sundbirsta'] = DrawingSundbirsta::getAllForObject($obj);
        $drawings['works'] = DrawingWorks::getAllForObject($obj);
        $drawings['department'] = DrawingDepartment::getAllForObject($obj);
        $drawings['standard_danieli'] = DrawingStandardDanieli::getAllForObject($obj);
        if ($drawings['danieli'] || $drawings['works'] || $drawings['department'] || $drawings['standard_danieli'] || $drawings['sundbirsta']) return $drawings;
        else return null;
    }
    
    //that objects do not occur in the specification in copy
    public static function deleteExistingObjects($objects, $children)
    {
        if (empty($children)) return $objects;
        foreach ($objects as $obj) {
            if (!ArrayHelper::isIn($obj->code, $children)) $remains[] = $obj;
        }
        return $remains;
    }
    
    public static function changeParentList($objects, $parent_id)
    {
        if (!$parent_id) throw new ForbiddenHttpException('error '.__METHOD__);
        foreach ($objects as $obj) {
            $obj->parent_id = $parent_id;
            $obj->save();
        }
        return $objects;    
    }  

	public static function highlightList($ids)
	{
		$ids = explode(',', trim($ids));
		$objects = Objects::findAll($ids);
		foreach ($objects as $obj) {
			if ($obj->color === 0) $obj->color = 1;
			else $obj->color = 0;
			$obj->save();
		}
	}
    
    public static function selectObjectsWithOrder($objects)
    {
        if (empty($objects)) return $objects;
        foreach ($objects as $object) {
            if ($object->orders) $objs_order[] = $object;
        }
        return $objs_order;
    }
    
    public static function setDimensions($item)
    {
        if (!$item->type_dimensions) return null;
        else $dimensions['type'] = $item->type_dimensions;
 
        if ($item->type_dimensions == 'nut') {
            $dimensions['thread'] = $item->nut_thread;
            $dimensions['pitch'] = $item->nut_pitch; 
			$dimensions['class'] = $item->nut_class;			
        }
        else if ($item->type_dimensions == 'bolt') {
            $dimensions['thread'] = $item->bolt_thread;
            $dimensions['pitch'] = $item->bolt_pitch; 
            $dimensions['length'] = $item->bolt_length;   
            $dimensions['class'] = $item->bolt_class;   
        }
        else if ($item->type_dimensions == 'shaft') {
            $dimensions['diam'] = $item->shaft_diam; 
            $dimensions['length'] = $item->shaft_length;   
        }
        else if ($item->type_dimensions == 'bush') {
            $dimensions['in_diam'] = $item->bush_in_diam;
            $dimensions['out_diam'] = $item->bush_out_diam; 
            $dimensions['height'] = $item->bush_height;   
        }
        else if ($item->type_dimensions == 'bar') {
            $dimensions['height'] = $item->bar_height; 
            $dimensions['length'] = $item->bar_length;   
            $dimensions['width'] = $item->bar_width;   
        }
        return $dimensions;
    }
    
        public static function getReserve($code)
    {
        $items_reseived = OrderActContent::findAll(['code' => $code, 'status' => self::STATUS_ACTIVE, 'state' => OrderActContent::STATE_RECEIVED]);
        $items_installed = OrderActContent::findAll(['code' => $code, 'status' => self::STATUS_ACTIVE, 'state' => OrderActContent::STATE_INSTALLED]);
        $summ_reseived = self::countReserve($items_reseived);
        $summ_installed = self::countReserve($items_installed);
        return $summ_reseived - $summ_installed;
    }
    
    private static function countReserve($items)
    {
        $summ = 0;
        if (!$items) return $summ;
        foreach ($items as $item) {
            $summ += $item->count;
        }
        return $summ;
    }
    
    public static function getEquipmentObject($obj)
    {
        $parent = Objects::getOne($obj->parent_id, false, self::STATUS_ACTIVE);
        if (!$parent || $parent->parent_id == 0) return false;
        if ($parent->type == 'equipment') return $obj->equipment = $parent;
        else self::getEquipmentObject($parent->parent_id);
    }
    
    public static function getDepartmentObject($parent_id)
    {
        $parent = Objects::getOne($parent_id, false, self::STATUS_ACTIVE);
        if (!$parent) return false;
        if ($parent->parent_id == 0) return $parent;
        else self::getDepartmentObject($parent->parent_id);
    }


}





