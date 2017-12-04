<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingStandardDanieli;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingDepartmentOld;
use app\modules\drawing\models\DrawingDanieli;
use app\models\InventoryNumber;

class SaveStandardDanieliController extends BaseController 
{
    public function actionIndex()
    {;
        //$text = file('files/standard/70.txt');
        foreach ($text as $str) {
            preg_match('/[0-9]{1}.[0-9]{6}.[A-Z]{1}/', $str, $matches); 
            if ($matches) $codes[] = $matches[0];   
        }
        $standards = DrawingStandardDanieli::find()->select('code')->column();
        foreach ($codes as $code) {
            if (in_array($code, $standards)) continue;
            else {
                $dwg = new DrawingStandardDanieli();
                $dwg->code = $code;
                $dwg->file = '70_st_dan.pdf';
                $dwg->save();
            }
        }
        //debug($standards);
        exit('end');
        
    }
    

    

    
}