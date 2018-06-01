<?php

namespace app\modules\order\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;
use app\modules\order\forms\OrderForm;
use app\modules\order\logic\OrderLogic;
use app\modules\orderact\models\OrderAct;

class OrderController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($order_id) 
    {
        $order = Order::get($order_id);
        return $this->render('index', compact('order', 'session'));
    }
    
    public function actionAll()
    {
        $params = OrderLogic::getParams();
        $orders = Order::getOrderList($params);
        $pages = Order::$pages;
        return $this->render('all', compact('orders', 'params', 'pages'));
    }
    
    public function actionForm($order_id = null) 
    { 
        $order = Order::getOne($order_id, null, self::STATUS_ACTIVE);
        if ($order) $order->convertDate($order, false)->getWork()->getShortCustomer()->getShortIssuer()->convertLocation();

        $form = new OrderForm($order);
        $form->getNumberOfFutureOrder()->getServices($form)->getSections()->getEquipments()->getUnits()->getGroups()->getSubgroups()->getUnitsSubgroup()->getInventories();
        $this->loadForm($form, $order);

        return $this->render('/order/form/index', compact('order', 'form'));
    }

    private function loadForm($form, $order)
    {
        if(!$form->load(Yii::$app->request->post()) || !$form->validate() || !$form->save($order)) return;
        Yii::$app->session->setFlash('success', 'Заказ успешно '.($order ? 'отредактирован' : 'создан'));
        OrderLogic::setSession($form->order->id, 'order-active');
        $this->redirect(['/order', 'order_id' => $form->order->id]);
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
        $this->redirect('/orders');
    }
    
    public function actionActs($order_id) 
    { 
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $acts = OrderAct::getAllForOrder($order_id);
        return $this->render('acts', compact('acts', 'order'));
    }

    public function actionCopy($order_id)
    {
        $new_id = OrderLogic::copyOrder($order_id);
        $this->redirect(['/order', 'order_id' => $new_id]);  
    }
    
    //set active order without create
    public function actionSetActive($order_id)
    {
        OrderLogic::setSession($order_id, 'order-active');
        $this->redirect(['/order', 'order_id' => $order_id]); 
    }
    
//    public function actionGetEquipmentForForm()
//    {
//        $area_id = Yii::$app->request->get('aree_id');
//        $equipment = Equipment::getEquipmentOfArea($area_id);
//        if (empty($equipment)) return 'error';
//        return json_encode($equipment);
//    }

    public function actionShowFilters()
    {
        $session = Yii::$app->session;
        $session->get('order-filters') ? $session->remove('order-filters') : $session->set('order-filters', true);
        return $this->redirect(Yii::$app->request->referrer);
    }
    
}