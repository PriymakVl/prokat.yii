<?php

namespace app\modules\equipments\controllers;

use Yii;
use app\controllers\BaseController;
use app\modules\equipments\models\Equipment;
use app\modules\equipments\forms\EquipmentForm;
use app\modules\equipments\logic\EquipmentLogic;

class EmployeeController extends BaseController 
{
    public $layout = "@app/views/layouts/base";
    /**
    public function actionIndex($order_id) 
    { 
        $order = Order::findOne($order_id);
        $order->getNumber()->convertDate($order)->convertService($order)->convertType()->countWeightOrder();
        $state = OrderLogic::checkState($order_id);
        return $this->render('index', compact('order', 'state'));
    }
    
    public function actionList($period = null)
    {
        $params = OrderLogic::getParams($period);
        $list = Order::getOrderList($params);
        $pages = Order::$pages;
        return $this->render('list', compact('list', 'params', 'pages'));
    }
    
    public function actionForm($order_id = null) 
    { 
        $order = (int)$order_id ? Order::findOne($order_id) : null;
        if ($order) $order->convertDate($order, false);
        $form = new OrderForm();
        $form->getServices($form);
        if($form->load(Yii::$app->request->post()) && $form->validate() && $form->save($order)) { 
            if ((int)$form->number) $this->redirect(['/order', 'order_id' => $form->order_id]);
            else $this->redirect(['/order/draft', 'order_id' => $form->order_id]);
        }   
        return $this->render('form', compact('order', 'form'));
    }
	**/
	public function actionAdd($name, $parent_id, $type)
	{
		$equipnment = new Equipment();
		$equipment->name = $name;
		$eqipment->parent_id = $parent_id;
		$equipment->type = $type;
		return $equipment->save();
		exit;
	}
    
   
    
}