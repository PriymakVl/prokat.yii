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
    
    public function actionForm($dwg_id = null) 
    { 
        $dwg = (int)$dwg_id ? DrawingWorks::findOne($dwg_id) : null;
        $form = new DrawingWorksForm();
        $form->getServices($form);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($dwg)) { 
            return $this->redirect(['/drawing/works', 'dwg_id' => $form->dwg_id]);
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
    
    public function actionDelete($dwg_id = null) 
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