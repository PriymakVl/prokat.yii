<?php

namespace app\modules\orderact\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\orderact\logic\OrderActLogic;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\models\OrderActContent;
use app\modules\orderact\forms\OrderActForm;

class OrderActController extends BaseController
{
    public $layout = "@app/views/layouts/base";
    
    public function actionIndex($act_id)
    {
        $act = OrderAct::getOne($act_id, false, self::STATUS_ACTIVE);
        $act->checkActive('order-act-active');
        $content = OrderActContent::getByActId($act->id);
        return $this->render('index', compact('act', 'content'));
    }
    
    public function actionList($mounth = null, $year = null, $state = null)
    {
        $params = OrderActLogic::getParams($mounth, $year, $state);
        $list = OrderAct::getActList($params);
        $pages = OrderAct::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($act_id)
    {     
        $act = OrderAct::getOne($act_id, false, self::STATUS_ACTIVE);
        $order = Order::getOne($act->order_id, false, self::STATUS_ACTIVE);
        $content = OrderActContent::getContentByActId($act->id);       
        $form = new OrderActForm();
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($act)) {
            Yii::$app->session->setFlash('success-order-act', 'Акт успешно отредактирован');
            return $this->redirect(['/order-act/active/set', 'act_id' => $form->act_id]);
        }        
        else return $this->render('form', compact('form', 'act', 'order', 'content'));    
    }
    
    public function actionRegistration($ids, $order_id, $number)
    {   
        $act_id = OrderAct::registration($number, $order_id);
        OrderActContent::setContentWhenRegistrationAct($act_id, $ids);
        $this->redirect(['/order-act/form', 'act_id' => $act_id]);   
    }
    
   public function actionDelete($act_id)
    {
        $result_act = OrderAct::deleteOne($act_id);
        $result_content = OrderActContent::deleteOne($act_id);
        if ($result_act && $result_content) Yii::$app->session->setFlash('success-order-act', 'Акт и содержимое успешно удалены');
        else Yii::$app->session->setFlash('error-order-act', 'При удалении акта произошла ошибка');
        $this->redirect('/order-act/list');   
    }
    
    public function actionSetActive($act_id)
    {
        OrderActLogic::setActive($act_id, 'order-act-active');
        $this->redirect(['/order-act', 'act_id' => $act_id]); 
    }
}
