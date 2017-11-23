<?php

namespace app\modules\drawing\logic;

use Yii;
use yii\web\ForbiddenHttpException;
use app\logic\BaseLogic;
use app\modules\drawing\models\DrawingDanieli;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\models\DrawingStandardDanieli;

class DrawingLogic extends BaseLogic
{
    const TYPE_DEPARTMENT = 'department';
    const TYPE_WORKS = 'works';
    const TYPE_DANIELI = 'danieli';
    const TYPE_SUNDBIRSTA = 'sundbirsta';
    const TYPE_STANDARD_DANIELI = 'standard_danieli';
    const TYPE_STANDARD = 'standard';
    
    //for drawing works;
    public static function saveFileWorks(DrawingWorks $dwg, $sheet, $filename)
    {
        if (!$filename) return $dwg;
        switch ($sheet) {
            case '1': $dwg->sheet_1 = $filename; break;
            case '2': $dwg->sheet_2 = $filename; break;
            case '3': $dwg->sheet_3 = $filename; break;
            //case '4': $dwg->sheet_4 = $filename;
            //case '5': $dwg->sheet_5 = $filename;
            default: return $dwg;
        }
        return $dwg;
    }
    
    public static function getParamsDepartment()
    {
        $params = [];
        if (self::in_get('year')) {
            $params['year'] = Yii::$app->request->get('year');
            $params['type'] = 'file';    
        }
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
        if ($category == self::TYPE_DEPARTMENT) $dwg = DrawingDepartment::getOne($dwg_id, false, self::STATUS_ACTIVE);
        else if ($category == self::TYPE_WORKS) $dwg = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE); 
        else if ($category == self::TYPE_DANIELI)$dwg = DrawingDanieli::getOne($dwg_id, false, self::STATUS_ACTIVE);
        else if ($category == self::TYPE_STANDARD_DANIELI)$dwg = DrawingStandardDanieli::getOne($dwg_id, false, self::STATUS_ACTIVE);
        return $dwg; 
    }
    
//    public static function getDrawingObjectByCode($category, $dwg_id, $obj)
//    {
//        $code = $obj->getCodeWithoutVariant($obj->code);
//        return ObjectDrawing::find()->where(['category' => $category, 'code' => $code, 'status' => self::STATUS_ACTIVE])->one();
//    }
    
    public static function countOfNumberDrawingsObject($drawings)
    {
        if (!empty($drawings['danieli']))$number = DrawingDanieli::countNumberDrawingsOneRevision($drawings['danieli']);
        if (!empty($drawings['works']))$number += count($drawings['works']);
        if (!empty($drawings['department']))$number += count($drawings['department']);
        if (!empty($drawings['standard_danieli']))$number += count($drawings['standard_danieli']);
        return $number;
    }
    
    public static function getPathDrawing($dwg)
    {
        switch ($dwg->category) {
            case 'danieli': return '/files/vendor/danieli/'.$dwg->file;
            case 'department': return '/files/department/'.$dwg->file;
            case 'works': return '/files/works/'.$dwg->sheet_1;
            case 'standard_danieli': return '/files/standard/danieli/'.$dwg->file;
            default: return '';
        }
    }
    
    public static function getNewNumberDepartmentDwg()
    {
        $current_year = date('Y');
        $new_year = $current_year.'-01-01';
        $new_year_time = strtotime($new_year);
        $drafts = DrawingDepartment::find()->where(['status' => DrawingDepartment::STATUS_ACTIVE])
            ->andWhere(['>', 'date', $new_year_time])
            ->orderBy(['number' => SORT_DESC])->all();
        return $drafts ? ($drafts[0]->number + 1) : 1;
    }
    
    
}





