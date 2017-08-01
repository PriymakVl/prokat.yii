<?php

namespace app\modules\drawing\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\forms\DrawingWorksFileForm;

class DrawingWorksFileController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionForm($file_id = null, $dwg_id = null) 
    { 
        $file = (int)$file_id ? DrawingWorksFile::findOne($file_id) : null;
        $dwg = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $form = new DrawingWorksFileForm();
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($file)) { 
            return $this->redirect(['/drawing/works/files', 'dwg_id' => $form->dwg_id]);
        }   
        return $this->render('form', compact('file', 'form', 'dwg'));
    }
    
    public function actionDelete($file_id = null) 
    {
        $file = DrawingWorksFile::getOne($file_id, false, self::STATUS_ACTIVE);
        $file->delete();
        return $this->redirect(['/drawing/works/files', 'dwg_id' => $file->dwg_id]);
    }
    
    public function actionSetParent($ids = null, $parent_id = null)
    {
        if (!$ids || !(int)$parent_id) return 'error';
        
        $ids = explode(',', trim($ids));
        $kit = DrawingWorks::findAll($ids);
        
        foreach ($kit as $dwg) {
            $dwg->parent_id = trim($parent_id);
            $dwg->update();
        } 
        return 'success';   
    }
    
}