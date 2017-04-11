<?php

namespace app\modules\objects\logic;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use app\logic\BaseLogic;
use app\modules\drawing\models\DrawingVendor;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\models\DrawingStandardDanieli;

class ObjectLogic extends BaseLogic
{
    
    public static function prepareChildren($children)
    {
        foreach ($children as $child) {
            $child->getName()->checkDrawing()->checkChild();
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
        $drawings['vendor'] = DrawingVendor::getAllForObject($obj);
        $drawings['works'] = DrawingWorks::getAllForObject($obj);
        $drawings['department'] = DrawingDepartment::getAllForObject($obj);
        $drawings['standard'] = DrawingStandardDanieli::getAllForObject($obj);
        if (self::checkArray($drawings)) return $drawings;
        else return null;
    }
    
    public static function checkDrawing($obj)
    {
        $drawings['vendor'] = DrawingVendor::check($obj);
        $drawings['works'] = DrawingWorks::check($obj);
        $drawings['department'] = DrawingDepartment::check($obj);
        $drawings['standard'] = DrawingStandardDanieli::check($obj);
        return self::checkArray($drawings);    
    }
    
    //that objects do not occur in the specification in copy
    public static function deleteExistingObjects($objects, $children)
    {
        if (empty($children)) return $objects;
        foreach ($objects as $obj) {
            if (ArrayHelper::isIn($obj->code, $children)) continue;
            $remains[] = $obj;
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
    


}





