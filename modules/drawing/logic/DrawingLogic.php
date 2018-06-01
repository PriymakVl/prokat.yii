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

        $params['year'] = Yii::$app->request->get('year');
        $params['status'] = self::STATUS_ACTIVE;
        return $params;
    }
    
    public static function getParamsWorks(){
        $params['departemt'] = Yii::$app->request->get('department');
        $params['$desinger'] = Yii::$app->request->get('$desinger');
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
        $drafts = DrawingDepartment::find()->where(['year' => $current_year, 'status' => DrawingDepartment::STATUS_ACTIVE])->orderBy(['id' => SORT_DESC])->all();
        if (empty($drafts)) return '27.'.$current_year.'.1';
        $number = self::getLastNumber($drafts, $current_year);
        return '27.'.date('y').'.'.++$number;
    }

    public static function getLastNumber($drafts, $year)
    {
        foreach ($drafts as $draft) {
            $pattern = '/^27\.18\.([1-9]{1,3})$/';
            preg_match($pattern, $draft->number, $matches);
            if($matches) break;
        }
        return $matches[1];
    }
    
    
}





