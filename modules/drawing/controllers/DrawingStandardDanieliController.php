<?php

namespace app\modules\drawing\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\models\drawings\Teg;
use app\modules\drawing\models\DrawingStandardDanieli;
use app\modules\drawing\models\forms\StandardDanieliDrawingForm;

class DrawingstandarddanieliController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionForm() 
    { 
        $form = new StandardDanieliDrawingForm();
        $result = Yii::$app->request->get('result');
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) { 
            $this->redirect(['/drawing/standard/danieli/form?result=success']);
        }   
        return $this->render('form', compact('form', 'result'));
    }
    
    public function actionAuto()
    {
        $path = 'files/standdanieli';
        $files = scandir($path);
        $pdf_files = $this->getFilesPdf($files);
        foreach ($pdf_files as $pdf) {
            $file_pdf = $this->renameFilePdf($pdf);
            if ($file_pdf) {
                $filename = explode('.', $pdf)[0];
                $codes = $this->selectCodesFromFile($filename);
                $this->saveCodesWithFileName($codes, $file_pdf);    
            }
            else exit('error');
        }
        die('success');
    }
    
    private function getFilesPdf($files) {
        for ($i = 2; $i < count($files); $i++) {
            $arr = explode('.', $files[$i]);
            if ($arr[1] == 'pdf') $pdf_files[] = $files[$i];
        }
        return $pdf_files;    
    }
    
    private function renameFilePdf($pdf)
    { 
        $name = 'files/standdanieli/'.$pdf;
        $new_name = rand(1, 10000).'_st_dan.pdf';
        if (file_exists('files/standard/danieli/'.$new_name)) {
            return $this->renameFilePdf($pdf);    
        }
        $path = 'files/standard/danieli/'.$new_name;
        if (copy($name, $path)) return $new_name;    
        return false;  
    }
    
    private function selectCodesFromFile($filename)
    {
        $path = 'files/standdanieli/'.$filename.'.txt';
        $content = file_get_contents($path);
        preg_match_all('/0.[0-9]{6}.[A-Z]{1}/', $content, $codes, PREG_PATTERN_ORDER);
        return $codes[0];  
    }
    
    private function saveCodesWithFileName($codes, $fileName)
    {
        foreach ($codes as $code)
        {
            $dwg = DrawingStandardDanieli::findOne(['code' => $code]);
            if (!$dwg) $dwg = new DrawingStandardDanieli();
            $dwg->code = $code;
            $dwg->equipment = 'danieli';
            if (!$dwg->file) $dwg->file = $fileName;
            //if (!$dwg->name) $dwg->name = $this->name;
//            if (!$dwg->note) $dwg->note = $this->note;
            $dwg->save();
        }
    }
    
    
    
}