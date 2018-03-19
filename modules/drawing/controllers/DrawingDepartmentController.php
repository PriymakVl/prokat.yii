<?php

namespace app\modules\drawing\controllers;

use Yii;
use yii\helpers\Url;
use app\controllers\BaseController;
use app\modules\drawing\models\DrawingDepartment;
use app\modules\drawing\forms\DrawingDepartmentForm;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDepartmentController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($dwg_id) 
    { 
        $dwg = DrawingDepartment::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $dwg->getFullNumber()->convertDate();
        return $this->render('index', compact('dwg'));
    }
    
    public function actionList()
    {
        $params = DrawingLogic::getParamsDepartment();
        $list = DrawingDepartment::getListDepartment($params);
        $pages = DrawingDepartment::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($dwg_id = null, $obj_id = null) 
    { 
        $dwg = DrawingDepartment::getOne($dwg_id, null, self::STATUS_ACTIVE);
        if ($dwg) $dwg->getFullNumber();
        else $number_new = '27.'.date('y').'.'.DrawingLogic::getNewNumberDepartmentDwg();
        $obj = Objects::getOne($obj_id, null, self::STATUS_ACTIVE);
        if ($obj) $obj->getName();
        $form = new DrawingDepartmentForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($dwg)) {
            if ($obj_id) return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
            else return $this->redirect(['/drawing/department', 'dwg_id' => $form->dwg->id]);
        }   
        return $this->render('form', compact('dwg', 'form', 'obj', 'number_new'));
    }

    public function actionDelete($dwg_id) 
    {
        $dwg = DrawingDepartment::getOne($dwg_id, false, self::STATUS_ACTIVE);
        if ($dwg->deleteOne()) return $this->redirect(['/drawing/department/list']); 
    }
    
//    public function actionSetParent($ids, $parent_id)
//    {
//		DrawingDepartment::setParentForList($ids, $parent_id);
//		return $this->redirect('/drawing/department/list');
//    }
    
}