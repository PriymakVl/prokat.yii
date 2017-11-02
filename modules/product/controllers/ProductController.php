<?php

namespace app\modules\product\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\product\models\Product;
use app\modules\product\forms\ProductForm;
use app\modules\product\logic\ProductLogic;
use app\modules\orderact\models\OrderActContent;
use app\modules\objects\models\Objects;

class ProductController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    
//    public function actionList($code) 
//    { 
//        $items = OrderActContent::findAll(['code' => $code, 'status' => self::STATUS_ACTIVE]);
//        return $this->render('index', compact('items, code'));
//    }
    
    public function actionManufactured($code, $month = null, $year = null, $order = null)
    {
        $params = ProductLogic::getParamsManufactured($code, $month, $year, $order);     
        $items = Product::manufactured($params);
        $pages = Product::$pages;
        $object = Objects::findOne(['code' => $code, 'status' => self::STATUS_ACTIVE]);
        $object->getName();
        return $this->render('manufactured', compact('items', 'params', 'pages', 'object'));
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
//            $this->redirect(['/order/active/set', 'order_id' => $form->order->id]);
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

    public function actionList($obj_id) 
    {
        $obj = Objects::getOne($obj_id, false, self::STATUS_ACTIVE);
        $obj->getName();
        if ($obj) $objects = Objects::searchCode($obj->code);
        return $this->render('list', compact('objects', 'obj'));   
    }
    

    
}