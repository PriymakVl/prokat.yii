<?php

namespace app\modules\drawing\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\forms\DrawingDepartmentForm;
use app\modules\drawing\logic\DrawingLogic;

class DrawingDepartmentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($dwg_id = null) 
    { 
        $dwg = DrawingDepartment::getOne($dwg_id, __METHOD__);
        $dwg->convertDate($dwg)->getNumber()->convertService()->checkChild();
        return $this->render('index', compact('dwg'));
    }
    
    public function actionList()
    {
        $params = DrawingLogic::getParamsDepartment();
        $list = DrawingDepartment::getListDepartment($params);
        $pages = DrawingDepartment::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($dwg_id = null) 
    { 
        $dwg = (int)$dwg_id ? DrawingDepartment::findOne($dwg_id) : null;
        $form = new DrawingDepartmentForm();
        $form->getServices($form);
        //add drawign to objecct
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($dwg)) { 
            return $this->redirect(['/drawing/department', 'dwg_id' => $form->dwg_id]);
        }   
        return $this->render('form', compact('dwg', 'form'));
    }
    
    public function actionFolder($dwg_id = null) 
    { 
        $folder = DrawingDepartment::getOne($dwg_id, __METHOD__);
        $folder->getContentOfFolder();
        return $this->render('folder', compact('folder'));
    }
    
    public function actionDelete($dwg_id = null) 
    {
        $dwg = DrawingDepartment::getOne($dwg_id, __METHOD__);
        if ($dwg->deleteOne()) return $this->redirect(['/drawing/department/list']); 
    }
    
    public function actionSetParent($ids = null, $parent_id = null)
    {
        if (!$ids || !(int)$parent_id) return 'error';
        $ids = explode(',', trim($ids));
        DrawingDepartment::changeParent(DrawingDepartment::findAll($ids), trim($parent_id));
        return 'success';   
    }
    
}