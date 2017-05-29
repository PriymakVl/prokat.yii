<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ObjectDrawingForm;
use app\modules\drawing\forms\NoteDrawingForm;
use app\modules\objects\logic\ObjectLogic;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\drawing\models\DrawingWorksFile;

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