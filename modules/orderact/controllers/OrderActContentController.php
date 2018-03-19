<?php

namespace app\modules\orderact\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\orderact\forms\OrderActContentForm;

class OrderActContentController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($item_id)
    {
        $item = OrderActContent::getOne($item_id, false, self::STATUS_ACTIVE);
        $act = OrderAct::getOne($item->act_id, false, self::STATUS_ACTIVE);
        $detail = OrderContent::getOne($item->item_id, false, self::STATUS_ACTIVE);
        $order = Order::getOne($detail->order_id, false, self::STATUS_ACTIVE);
        return $this->render('index', compact('item', 'detail', 'order', 'act'));
    }
    
    public function actionList($month = null, $year = null, $customer = null)
    {
        $params = OrderActLogic::getParamsContent($month, $year, $customer);
        $list = OrderActContent::getList($params);
        $pages = OrderActContent::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
//    public function actionListMonth($month = null, $year = null, $customer = null)
//    {
//        $params = OrderListLogic::getParams($month);
//        $list_list = OrderList::getList($params);
//        $pages = OrderList::$pages;
//        return $this->render('list', compact('list_list', 'params', 'pages'));
//    }
    
    public function actionForm($act_id, $item_id = null)
    {     
        $item = OrderActContent::getOne($item_id, null, self::STATUS_ACTIVE);
        if ($item) $item->getItemOrder()->getName();
        $act = OrderAct::getOne($act_id, false, self::STATUS_ACTIVE); 
        $act->getOrder();
        $form = new OrderActContentForm($item, $act);
        
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            Yii::$app->session->setFlash('success', 'Элемент акта успешно '.($item ? 'отредактирован' : 'создан'));
            return $this->redirect(['/order/act', 'act_id' => $form->item->act_id]);
        }        
        else return $this->render('form', compact('form', 'item', 'act'));    
    }
    
   public function actionDelete($item_id)
    {
        $item = OrderActContent::getOne($item_id, false, self::STATUS_ACTIVE);
        $item->deleteOne();
        \Yii::$app->session->setFlash('success', 'Элемент успешно удален');
        return $this->redirect(\Yii::$app->request->referrer);   
    }
    
    public function actionSetActive($list_id)
    {
        OrderListLogic::setActive($list_id, 'order-list-active');
        $this->redirect(['/order-list', 'list_id' => $list_id]); 
    }
}
