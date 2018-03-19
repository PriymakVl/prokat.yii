<?php

namespace app\modules\orderact\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\orderact\forms\OrderActForm;
use app\modules\order\models\Order;
use app\modules\order\models\OrderContent;

class OrderActController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($act_id)
    {
        $act = OrderAct::getOne($act_id, false, self::STATUS_ACTIVE);
        $act->getOrder()->convertDepartment()->getPeriod()->convertState();
        $act->checkActive('order-act-active');
        $content = OrderActContent::getContentByActId($act->id);
        return $this->render('index', compact('act', 'content'));
    }
    
    public function actionList()
    {
        $params = OrderActLogic::getParams();
//        debug($params);
        $list = OrderAct::getActList($params);
        $month_selected = self::getMonthString($params['month'] ? $params['month'] : date('m'), true);
        $year_selected = $params['year'] ? $params['year'].'г.' : date('Y').'г.';
        $period = $month_selected.' '.$year_selected; 
        $costs = OrderActLogic::countCostMonth($month, $year);
        $count = count($list);
        $session = Yii::$app->session;
        return $this->render('list', compact('list', 'params', 'period', 'costs', 'count'));
    }
    
    public function actionForm($act_id = null)
    {     
        $act = OrderAct::getOne($act_id, null, self::STATUS_ACTIVE);
        if ($act) {
            $act->getOrder();
            $content = OrderActContent::getContentByActId($act->id);
        }
        $order = $act ? Order::getOne($act->order_id, false, self::STATUS_ACTIVE) : null;

        $form = new OrderActForm($act, $content);
        $form->getMonths();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save()) {
            $message = $act_id ? 'Акт успешно отредактирован' : 'Акт успешно создан';
            Yii::$app->session->setFlash('success', $message);
            return $this->redirect(['/order/act', 'act_id' => $form->act->id]);
        }        
        else return $this->render('form', compact('form', 'act', 'order', 'content'));
    }
    
    public function actionRegistration($ids, $order_id, $number)
    {   
        $act_id = OrderAct::registration($number, $order_id);
        $items = OrderContent::findAll(explode(',', $ids));
        foreach ($items as $item) {
            $act_item = new OrderActContent();
            $act_item->setDataWhenRegistrationAct($act_id, $item);
            $act_item->save();
        }
        $this->redirect(['/order/act/form', 'act_id' => $act_id]);   
    }
    
    public function actionDelete($act_id)
    {
        $act = OrderAct::findOne($act_id);
        if ($act) {
            $act->deleteOne();
            OrderActLogic::deleteActContent($act->id);
            \Yii::$app->session->setFlash('success', 'Акт успешно удален');
            $this->redirect('/order/act/list'); 
        }
        else {
                \Yii::$app->session->setFlash('danger', 'При удалении акта произошла ошибка');
                $this->redirect(['/order/act', 'act_id' => $act->id]);    
        }  
    }
    
    public function actionDeleteList($ids)
    {
        $result = OrderActLogic::deleteActs($ids);
        if ($result) \Yii::$app->session->setFlash('success', 'Акты успешно удалены');
        else \Yii::$app->session->setFlash('danger', 'При удалении актов произошла ошибка');
        $this->redirect('/order/act/list');   
    }
    
    public function actionEditState($ids)
    {
        OrderActLogic::editActState($ids);
        return $this->redirect(\Yii::$app->request->referrer);
    }
    
    public function actionSetActive($act_id)
    {
        OrderActLogic::setActive($act_id, 'order-act-active');
        $this->redirect(['/order-act', 'act_id' => $act_id]); 
    }

    public function actionShowFilters()
    {
        $session = Yii::$app->session;
        $session->get('act-filters') ? $session->remove('act-filters') : $session->set('act-filters', true);
        return $this->redirect(Yii::$app->request->referrer);
    }


}
