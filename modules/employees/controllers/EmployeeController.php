<?php

namespace app\modules\employees\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\employeers\models\Employee;
use app\modules\employeers\forms\EmployeeForm;
use app\modules\employeers\logic\EmployeeLogic;

class EmployeeController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($order_id) 
    { 
        $order = Order::findOne($order_id);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder();
        $state = OrderLogic::checkState($order_id);
        return $this->render('index', compact('order', 'state'));
    }
    
    public function actionList($period = null)
    {
        $params = OrderLogic::getParams($period);
        $list = Order::getOrderList($params);
        $pages = Order::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($order_id = null) 
    { 
        $order = (int)$order_id ? Order::findOne($order_id) : null;
        if ($order) $order->convertDate($order, false);
        $form = new OrderForm();
        $form->getServices($form);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($order)) { 
            if ((int)$form->number) $this->redirect(['/order', 'order_id' => $form->order_id]);
            else $this->redirect(['/order/draft', 'order_id' => $form->order_id]);
        }   
        return $this->render('form', compact('order', 'form'));
    }
    
    public function actionWork($order_id)
    {
        $order = Order::findOne($order_id);
        $order->getNumber();
        return $this->render('work', compact('order'));   
    }
    
    public function actionDraft($order_id)
    {
        $order = Order::getDraft($order_id);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType();
                //debug($order);
        $state = OrderLogic::checkState($order_id);
        return $this->render('index', compact('order', 'state'));    
    }
    
    public function actionDraftsList()
    {
        $drafts = Order::getDraftsList();
        return $this->render('drafts', compact('drafts'));       
    }
    
    public function actionDelete($order_id)
    {
        $order = Order::findOne($order_id);
        $order->deleteOne();
        $this->redirect('/order/list');   
    }
    
    public function actionContent($std_id = null) 
    { 
        $parent = Standard::findOne($std_id);
        if (!$parent) $this->showError(__METHOD__);
        $children = Standard::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $std_id]);
        return $this->render('content', compact('parent', 'children'));
    }
    
    public function actionSetActive($order_id)
    {
        $order = Order::findOne(['id' => $order_id]);
        OrderLogic::setSessionActiveOrder($order_id);
        if ((int)$order->number)$this->redirect(['/order', 'order_id' => $order_id]); 
        else $this->redirect(['/order/draft', 'order_id' => $order_id]);
    }
    
    public function actionGetActive()
    {
        $order_id = OrderLogic::getActiveOrderId();
        $this->redirect(['/order', 'order_id' => $order_id]);
    }
    
}