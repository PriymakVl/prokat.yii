<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ObjectDrawingForm;
use app\modules\objects\forms\ObjectDrawingVendorForm;
use app\modules\objects\forms\ObjectDrawingUpdateForm;
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
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName();
        $form = new ObjectDrawingForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($obj)) { 
            //Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->redirect(['/object/drawing', 'obj_id' => $obj->id]);
        }
        return $this->render('form', compact('obj', 'form'));       
    }
	
    //set code object number dwg
    public function actionSetCodeObject($dwg_cat, $dwg_id, $obj_id)
    {
        debug($dwg_id);
        $obj = Objects::getOne($obj_id, null, self::STATUS_ACTIVE);
        debug(explode('-', $obj->code)[0]);
        if (explode('-', $obj->code) != $obj->id) {
           Yii::$app->session->setFlash('error', 'Код этого объекта можно изменить только в форме');
           return $this->redirect(['/object/drawing', 'obj_id' => $obj->id]); 
        }
        $dwg = DrawingLogic::getDrawingObject($dwg_cat, $dwg_id);
        $obj->code = $dwg->number;
        $obj->save();
        Yii::$app->session->setFlash('success', 'Код объекта успешно изменен');
        return $this->redirect(['/object', 'obj_id' => $obj->id]); 
    }
    
    public function actionDelete($dwg_id, $dwg_cat, $obj_id) 
    {
        $dwg = DrawingLogic::getDrawingObject($dwg_cat, $dwg_id);
        if ($dwg) {
            $dwg->obj_id = null;
            $dwg->code = null;
            $dwg->save(); 
        }
        $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
    }
        
    //add note 
//    public function actionNote($dwg_id, $dwg_cat, $obj_id, $file_id = null) 
//    {
//        $form = new NoteDrawingForm;
//        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
//        $obj->getName();
//        $dwg = Drawinglogic::getDrawingObject($dwg_cat, $dwg_id);
//        if ($dwg->category == 'works') $file = DrawingWorksFile::getOne($file_id, null, self::STATUS_ACTIVE);
//        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->updateNote($dwg, $file_id)) {
//            return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
//        } 
//        //debug($form, false);
//        return $this->render('note_form', compact('form', 'obj', 'dwg', 'file'));
//    }

}