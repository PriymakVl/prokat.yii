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
    
//    public static function checkDrawing($obj)
//    {
//        $drawings['danieli'] = DrawingDanieli::check($obj);
//        $drawings['works'] = DrawingWorks::check($obj);
//        $drawings['department'] = DrawingDepartment::check($obj);
//        $drawings['standard_danieli'] = DrawingStandardDanieli::check($obj);
//        if ($drawings['danieli'] || $drawings['works'] || $drawings['department'] || $drawings['standard_danieli']) return true;
//        else return false;
//        //return self::checkArray($drawings);    
//    }
    
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


}





