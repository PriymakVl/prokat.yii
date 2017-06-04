<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ObjectDrawingForm;
use app\modules\objects\forms\ObjectDrawingVendorForm;
use app\modules\drawing\forms\NoteDrawingForm;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\drawing\models\DrawingWorksFile;
use app\modules\drawing\models\DrawingVendor;

class ObjectDrawingController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($obj_id) 
    { 
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName();
        $drawings = ObjectLogic::getDrawings($obj);
        return $this->render('index', compact('obj', 'drawings'));
    }
    
    public function actionForm($obj_id)
    {
        $obj = Objects::getOne($obj_id, __METHOD__, self::STATUS_ACTIVE);
        $obj->getName();
        $form = new ObjectDrawingForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($obj)) { 
            return $this->redirect(['/object/drawing', 'obj_id' => $obj->id]);
        }
        return $this->render('form', compact('obj', 'form'));       
    }
    
    public function actionUpdateVendor($dwg_id, $obj_id) 
    {
        $dwg = DrawingVendor::getOne($dwg_id, __METHOD__, self::STATUS_ACTIVE);
        $form = new ObjectDrawingVendorForm(); 
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($dwg)) { 
            return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
        } 
        return $this->render('update_vendor', compact('obj', 'form', 'dwg'));  
    }
    
    public function actionDelete($dwg_id, $dwg_cat, $obj_id) 
    {
        $obj = Objects::getOne($obj_id, __METHOD__, self::STATUS_ACTIVE);
        $dwg = DrawingLogic::getDrawingObjectByCode($dwg_cat, $dwg_id, $obj);
        if ($dwg) {
            $dwg->status = self::STATUS_INACTIVE;
            $dwg->save(); 
        }
        $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
    }
        
    //add note 
    public function actionNote($dwg_id, $dwg_cat, $obj_id, $file_id = null) 
    {
        $form = new NoteDrawingForm;
        $obj = Objects::getOne($obj_id, __METHOD__, self::STATUS_ACTIVE);
        $obj->getName();
        $dwg = Drawinglogic::getDrawingObject($dwg_cat, $dwg_id);
        if ($dwg->category == 'works') $file = DrawingWorksFile::getOne($file_id, null, self::STATUS_ACTIVE);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->updateNote($dwg, $file_id)) {
            return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
        } 
        //debug($form, false);
        return $this->render('note_form', compact('form', 'obj', 'dwg', 'file'));
    }

}