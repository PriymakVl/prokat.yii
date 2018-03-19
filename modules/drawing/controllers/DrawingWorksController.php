<?php

namespace app\modules\drawing\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\modules\drawing\models\DrawingWorks;
use app\modules\drawing\forms\DrawingWorksForm;
use app\modules\drawing\logic\DrawingLogic;

class DrawingWorksController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($dwg_id) 
    { 
        $dwg = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $dwg->convertDate($dwg)->getObject()->getName();
        return $this->render('index', compact('dwg'));
    }
    
    public function actionList()
    {
        $params = DrawingLogic::getParamsWorks();
        $list = DrawingWorks::getListWorks($params);
		$pages = DrawingWorks::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($dwg_id = null, $obj_id = null) 
    { 
        //debug(Yii::$app->request->referrer, false);
        $dwg = DrawingWorks::getOne($dwg_id, null, self::STATUS_ACTIVE);
        $form = new DrawingWorksForm($dwg);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) { 
            Yii::$app->session->setFlash('success', $dwg ? 'Чертеж успешно отредактирован' : 'Чертеж успешно создан');
            //return $this->redirect(Yii::$app->request->referrer);
            if ($obj_id) return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
            else return $this->redirect(['/drawing/works', 'dwg_id' => $form->dwg->id]);
        }   
        return $this->render('form', compact('dwg', 'form'));
    }
    
    public function actionSpecification($dwg_id = null) 
    { 
        $parent = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $parent->checkChild();
        $specification = DrawingWorks::getSpecification($parent->id);
        return $this->render('specification', compact('specification', 'parent'));
    }
    
    public function actionFiles($dwg_id = null) 
    { 
        $dwg = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $dwg->checkChild()->getFiles();
        return $this->render('files', compact('dwg'));
    }
    
    public function actionDelete($dwg_id)
    {
        $dwg = DrawingWorks::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $dwg->deleteOne();
        return $this->redirect(['/drawing/works/list']);
    }
    
    public function actionSetParent($ids, $parent_id)
    {
		DrawingWorks::setParentForList($ids, $parent_id);
		return $this->redirect('/drawing/works/list');
    }
    
}