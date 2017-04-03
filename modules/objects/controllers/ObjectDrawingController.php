<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ObjectDrawingForm;
use app\modules\drawing\forms\NoteDrawingForm;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;

class ObjectDrawingController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($obj_id) 
    { 
        $obj = Objects::getOne($obj_id);
        $obj->getName();
        $drawings = ObjectLogic::getDrawings($obj);
        return $this->render('index', compact('obj', 'drawings'));
    }
    
    public function actionForm($obj_id)
    {
        $obj = Objects::getOne($obj_id);
        $obj->getName();
        $form = new ObjectDrawingForm();
        $form->getCategories();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($obj)) { 
            return $this->redirect(['/object/drawing', 'obj_id' => $obj->id]);
        }
        return $this->render('form', compact('obj', 'form'));       
    }
    
    public function actionDelete($dwg_id = null, $dwg_cat = null, $obj_id = null) 
    {
        $dwg = DrawingLogic::getDrawingObject($dwg_cat, $dwg_id);
        $dwg->obj_id = 0;
        $dwg->code = '';
        if ($dwg->save()) $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
    }
        
    //add note 
    public function actionNote($dwg_id = null, $dwg_cat = null, $obj_id = null, $file_id = null) 
    {
        $form = new NoteDrawingForm;
        $dwg = $form::getDrawing($dwg_id, $dwg_cat);
        if ($dwg_cat == 'works') $file = DrawingWorksFile::findOne($file_id);
        else $file = null;
        //debug($file);
        if (!$dwg) exit('error modules Drawing controller Drawingobject, method actionNote');
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->updateNote($dwg, $file)) {
            return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
        } 
        //debug($form, false);
        return $this->render('note_form', ['dwg' => $dwg, 'form' => $form, 'file' => $file]);
    }

}