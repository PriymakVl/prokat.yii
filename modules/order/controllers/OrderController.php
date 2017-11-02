<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\order\forms\OrderForm;
use app\modules\order\logic\OrderLogic;

class OrderController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($order_id) 
    {   
        $order = Order::get($order_id);
        return $this->render('index', compact('order', 'session'));
    }
    
    public function actionList($period = null, $customer = null, $section = null, $equipment = null, $unit = null, $type = null)
    {
        $state = Yii::$app->request->get('state');
        $params = OrderLogic::getParams($period, $customer, $section, $equipment, $unit, $state, $type);
        $list = Order::getOrderList($params);
        $pages = Order::$pages;
        return $this->render('list', compact('list', 'params', 'pages', 'state'));
    }
    
    public function actionForm($order_id = null) 
    { 
        $order = Order::getOne($order_id, null, self::STATUS_ACTIVE);
        if ($order) $order->convertDate($order, false)->getWork()->getShortCustomer()->getShortIssuer()->convertLocation();
        //debug($order);
        $form = new OrderForm($order);
        $form->getNumberOfFutureOrder()->getServices($form)->getSections()->getEquipments()
            ->getUnits()->getNameEquipment()->getNameUnit();
        //debug($form->unit);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($order)) { 
            Yii::$app->session->setFlash('success', 'Заказ успешно '.($order ? 'отредактирован' : 'создан'));
            OrderLogic::setActive($form->order->id, 'order-active');
            $this->redirect(['/order', 'order_id' => $form->order->id]);
        }   
        //Debug($order);
        return $this->render('form', compact('order', 'form'));
    }
    
    //выводит страницу характер работы по заказу
    public function actionWork($order_id)
    {
        $order = Order::findOne($order_id);
        $order->getNumber()->getWork();
        return $this->render('work', compact('order'));   
    }
    
    public function actionDelete($order_id)
    {
        $order = Order::findOne($order_id);
        $order->deleteOne();
        $this->redirect('/order/list');   
    }
    
//    public function actionContent($std_id = null) 
//    { 
//        $parent = Standard::findOne($std_id);
//        if (!$parent) $this->showError(__METHOD__);
//        $children = Standard::findAll(['status' => self::STATUS_ACTIVE, 'parent_id' => $std_id]);
//        return $this->render('content', compact('parent', 'children'));
//    }

    public function actionCopy($order_id, $number)
    {
        $new_id = OrderLogic::copyOrder($order_id, $number);
        $this->redirect(['/order', 'order_id' => $new_id]);  
    }
    
//    public function actionSetActive($order_id)
//    {
//        OrderLogic::setActive($order_id, 'order-active');
//        $this->redirect(['/order', 'order_id' => $order_id]); 
//    }
    
//    public function actionGetActive()
//    {
//        $order_id = OrderLogic::getActive();
//        $this->redirect(['/order', 'order_id' => $order_id]);
//    }
    
    public function actionGetEquipmentForForm()
    {
        $area_id = Yii::$app->request->get('aree_id');
        $equipment = Equipment::getEquipmentOfArea($area_id);
        if (empty($equipment)) return 'error';
        return json_encode($equipment);
    }
    
}