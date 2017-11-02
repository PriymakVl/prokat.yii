<?php

namespace app\modules\objects\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\objects\models\Objects;
use app\modules\objects\forms\ObjectForm;

class ObjectController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
      
    public function actionIndex($obj_id) 
    { 
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName()->getParent()->getNumberOfDrawings()->checkChild()->getOrders()->convertDimensions()->getReserve();
        return $this->render('index', compact('obj'));
    }
    
    public function actionOrders($obj_id) 
    { 
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName()->getOrders();
        return $this->render('orders', compact('obj'));
    }
    
    public function actionForm($obj_id = null)
    {
        $parent_id = Yii::$app->request->get('parent_id');
        $obj = $obj_id ? Objects::findOne($obj_id) : null;       
        $form = new ObjectForm($obj);
        $form->getTypes()->getEquipments(); 

        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            return $this->redirect(['/object', 'obj_id' => $form->obj->id]);
        }        
        return $this->render('form', compact('form', 'obj', 'parent_id'));     
    }
    
    public function actionCopy($obj_id, $parent_id)
    {
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->copy($parent_id);
        $this->redirect(['/object', 'obj_id' => $obj->id]);
    }
    
    public function actionDeleteOne($obj_id)
    {
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $parent_id = $obj->parent_id;
        $obj->delete();
        if($parent_id == 0) $this->redirect(Yii::$app->getHomeUrl());
        else $this->redirect(['/object/specification', 'obj_id' => $parent_id]);   
    }
    
    
}