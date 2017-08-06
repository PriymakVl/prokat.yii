<?php

namespace app\modules\orderlist\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderlist\logic\OrderListLogic;
use app\modules\orderlist\models\OrderList;
use app\modules\orderlist\models\OrderListContent;
use app\modules\orderlist\forms\OrderListForm;

class OrderListController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($list_id)
    {
        $list = OrderList::getOne($list_id, false, self::STATUS_ACTIVE);
        //if ($list) $content = OrderListContent::getBylistId($list->id);
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
            Yii::$app->session->setFlash('success-order-list', 'Список заказов успешно создан');
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
        $list = OrderList::getOne($list_id, false, self::STATUS_ACTIVE);
        OrderListLogic::setActive($list_id);
        $this->redirect(['/order-list', 'list_id' => $list->id]); 
    }
    
    public function actionGetActive()
    {
        $list_id = OrderListLogic::getActive();
        $this->redirect(['/order-list', 'list_id' => $application_id]);
    }
}
