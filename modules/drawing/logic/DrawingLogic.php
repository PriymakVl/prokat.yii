<?php

namespace app\modules\drawing\logic;

use Yii;
use yii\web\ForbiddenHttpException;
use app\logic\BaseLogic;
use app\modules\drawing\models\DrawingVendor;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;

class DrawingLogic extends BaseLogic
{
    const TYPE_DEPARTMENT = 'department';
    const TYPE_WORKS = 'works';
    const TYPE_VENDOR = 'vendor';
    
    //for drawing works;
    public static function getFiles($drawings)
    {
        if (empty($drawings)) return false;
        foreach ($drawings as $dwg) {
            $dwg->getFiles();
        }
        return $drawings;
    }
    
    public static function getParamsDepartment()
    {
        $params = [];
        if (self::in_get('year')) $params['year'] = Yii::$app->request->get('year');
        $params['parent_id'] = 0;
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }
    
    public static function getParamsWorks(){
        $params = [];
        if (self::in_get('department')) $params['departemt'] = Yii::$app->request->get('department');
        if (self::in_get('$desinger')) $params['$desinger'] = Yii::$app->request->get('$desinger');
        $params['parent_id'] = 0;
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }
    
    public static function getDrawingObject($category, $dwg_id)
    {
        if ($category == self::TYPE_DEPARTMENT) $dwg = DrawingDepartment::findOne($dwg_id, false, self::STATUS_ACTIVE);
        else if ($category == self::TYPE_WORKS) $dwg = DrawingWorks::findOne($dwg_id, false, self::STATUS_ACTIVE); 
        else $dwg = DrawingVendor::getOne($dwg_id, false, self::STATUS_ACTIVE);
        return $dwg; 
    }
    
    public static function countOfNumberDrawingsObject($drawings)
    {
        if (!empty($drawings['vendor']))$number = count($drawings['vendor']);
        if (!empty($drawings['works']))$number += count($drawings['works']);
        if (!empty($drawings['department']))$number += count($drawings['department']);
        if (!empty($drawings['standard']))$number += count($drawings['standard']);
        return $number;
    }
    
}





