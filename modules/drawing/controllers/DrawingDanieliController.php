<?php

namespace app\modules\drawing\controllers;

use app\controllers\BaseController;
use app\modules\drawing\models\DrawingDanieli;
use app\modules\drawing\forms\DrawingDanieliForm;
use app\modules\drawing\logic\DrawingLogic;
use app\modules\objects\models\Objects;

class DrawingDanieliController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
//    public function actionIndex($dwg_id) 
//    { 
//        $dwg = DrawingDepartment::getOne($dwg_id, false, self::STATUS_ACTIVE);
//        $dwg->convertDate($dwg)->getFullNumber()->getObject();
//        return $this->render('index', compact('dwg'));
//    }
    
//    public function actionList()
//    {
//        $params = DrawingLogic::getParamsDepartment();
//        $list = DrawingDepartment::getListDepartment($params);
//        $pages = DrawingDepartment::$pages;
//        return $this->render('list', compact('list', 'params', 'pages'));
//    }
    
    public function actionForm($dwg_id, $obj_id) 
    { 
        $dwg = DrawingDanieli::getOne($dwg_id, false, self::STATUS_ACTIVE);
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName();
        $form = new DrawingDanieliForm($dwg);
        if($form->load(\Yii::$app->request->post()) && $form->validate() && $form->save()) { 
            return $this->redirect(['/object/drawing', 'obj_id' => $obj_id]);
        }   
        return $this->render('form', compact('dwg', 'form', 'obj'));
    }
    
    
}