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
        if ($category == self::TYPE_DEPARTMENT) $dwg = DrawingDepartment::findOne($dwg_id);
        else if ($category == self::TYPE_WORKS) $dwg = DrawingWorks::findOne($dwg_id); 
        if (!$dwg) throw new ForbiddenHttpException('error '.__METHOD__); 
        return $dwg; 
    }
    
}





