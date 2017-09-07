<?php
namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingDepartmentOld;

class DatabaseController extends BaseController 
{
    public function actionIndex()
    {
        $old = DrawingDepartmentOld::findAll(['status' => self::STATUS_ACTIVE]);
        foreach ($old as $dwg_old) {
            if ($dwg_old->type == 'folder') $dwg->status = 0;
            $dwg = new DrawingDepartment();
            $dwg->obj_id = $dwg_old->obj_id;
            $dwg->code = $dwg_old->code;
            $dwg->number = $dwg_old->id;
            $dwg->file = $dwg_old->file;
            $note = $file ? $file->note : '';
            $dwg->note = $dwg_old->note ? $dwt_old->note : $note;
            $dwg->date = $dwg_old->date; 
            $dwg->name = $dwg_old->name;
            //debug($dwg);
            $dwg->save();  
        }
        exit('end');
    }
    
   // private function writefile($data)
//    {
//        foreach ($data as $array) {
//            $str = implode(';', $array);
//            file_put_contents ("files/excel/bolt_weight.txt", $str.PHP_EOL, FILE_APPEND);
//        }
//    }
    

    
}