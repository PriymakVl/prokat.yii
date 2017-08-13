<?php

namespace app\modules\orderact\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\orderact\forms\OrderActForm;

class OrderActContentController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($list_id)
    {
        $list = OrderList::getOne($list_id, false, self::STATUS_ACTIVE);
        $list->convertType()->checkActive('order-list-active');
        //$content = OrderListContent::getBylistId($list->id);
        return $this->render('index', compact('list', 'content'));
    }
    
    public function actionList($type = null)
    {
        $params = OrderListLogic::getParams($type);
        $list_list = OrderList::getList($params);
        $pages = OrderList::$pages;
        return $this->render('list', compact('list_list', 'params', 'pages'));
    }
    
    public function actionForm($list_id = null)
    {     
        $list = OrderList::getOne($list_id, null, self::STATUS_ACTIVE);       
        $form = new OrderListForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($list)) {
            Yii::$app->session->setFlash('success-order-list', 'Список заказов успешно '.($list ? 'отредактирован' : 'создан'));
            return $this->redirect(['/order-list/active/set', 'list_id' => $form->list_id]);
        }        
        else return $this->render('form', compact('form', 'list'));    
    }
    
   public function actionDelete($list_id)
    {
        $list = OrderList::getOne($list_id, false, self::STATUS_ACTIVE);
        $list->deleteOne();
        $this->redirect('/order-list/list');   
    }
    
    public function actionSetActive($list_id)
    {
        OrderListLogic::setActive($list_id, 'order-list-active');
        $this->redirect(['/order-list', 'list_id' => $list_id]); 
    }
}
