<?php

namespace app\modules\chain\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\chain\logic\ChainLogic;
use app\modules\chain\models\ChainIso;

class ChainIsoController extends BaseController
{
    public $layout = "@app/views/layouts/base";

    public function actionIndex($chain_id)
    {
        $chain = ChainIso::findeOne(['id' => $chain_id, null, 'status' => self::STATUS_ACTIVE]);
        return $this->render('index', compact('chain'));
    }

    public function actionList()
    {
        $params = ChainLogic::getParamsChainsIso();
        $iso = ChainIso::getChainList($params);
        return $this->render('list', compact('iso', 'params'));
    }

//    public function actionForm($order_id = null)
//    {
//        $order = Order::getOne($order_id, null, self::STATUS_ACTIVE);
//        if ($order) $order->convertDate($order, false)->getWork()->getShortCustomer()->getShortIssuer()->convertLocation();
//        //debug($order);
//        $form = new OrderForm($order);
//        $form->getNumberOfFutureOrder()->getServices($form)->getSections()->getEquipments()
//            ->getUnits()->getNameEquipment()->getNameUnit();
//        //debug($form->unit);
//        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($order)) {
//            Yii::$app->session->setFlash('success', 'Заказ успешно '.($order ? 'отредактирован' : 'создан'));
//            OrderLogic::setActive($form->order->id, 'order-active');
//            $this->redirect(['/order', 'order_id' => $form->order->id]);
//        }
//        //Debug($order);
//        return $this->render('form', compact('order', 'form'));
//    }

//    public function actionDelete($order_id)
//    {
//        $order = Order::findOne($order_id);
//        $order->deleteOne();
//        $this->redirect('/order/list');
//    }

}
    
