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
        $acts = OrderAct::getAllForOrder($order_id);
        $count_acts = $acts ? count($acts) : 0;
        return $this->render('index', compact('order', 'session', 'count_acts'));
    }
    
    public function actionList($period = null, $customer = null, $section = null, $equipment = null, $unit = null, $type = null, $kind = null)
    {
        $state = Yii::$app->request->get('state');
        $params = OrderLogic::getParams($period, $customer, $section, $equipment, $unit, $state, $type, $kind);
                //debug($params);
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
        $acts = OrderAct::getAllForOrder($order_id);
        $count_acts = $acts ? count($acts) : 0;
        return $this->render('work', compact('order', 'count_acts'));   
    }
    
    public function actionDelete($order_id)
    {
        $order = Order::findOne($order_id);
        $order->deleteOne();
        $this->redirect('/order/list');   
    }
    
    public function actionActs($order_id) 
    { 
        $order = Order::getOne($order_id, false, self::STATUS_ACTIVE);
        $acts = OrderAct::getAllForOrder($order_id);
        $count_acts = $acts ? count($acts) : 0;
        return $this->render('acts', compact('acts', 'order', 'count_acts'));    
    }

    public function actionCopy($order_id, $number)
    {
        $new_id = OrderLogic::copyOrder($order_id, $number);
        $this->redirect(['/order', 'order_id' => $new_id]);  
    }
    
    //set active order without create
    public function actionSetActive($order_id)
    {
        OrderLogic::setActive($order_id, 'order-active');
        $this->redirect(['/order', 'order_id' => $order_id]); 
    }
    
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