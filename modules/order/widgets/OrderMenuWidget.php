<?php

namespace app\modules\order\widgets;

use yii\base\Widget;
use app\modules\orderact\models\OrderAct;

class OrderMenuWidget extends Widget
{
    public $type;
    public $params;
    public $item_id;
    public $order_id;

    public function run()
    {
        return $this->getMenu();
    }

    private function getMenu()
    {
        switch ($this->type) {
            case 'orders': return $this->render('menu/orders');
            case 'top-order': return $this->getTopMenuOrder();
            case 'order': return $this->render('menu/order', ['order_id' => $this->order_id]);
            case 'order-content': return  $this->getMenuOrderContent();
            case 'form-order': return $this->render('topmenu/order-form');
            case 'form-content': return $this->render('topmenu/content-form');
        }
    }

    private function getTopMenuOrder()
    {
        $acts = OrderAct::getAllForOrder($this->order_id);
        $count_acts = $acts ? count($acts) : 0;
        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;
        return $this->render('topmenu/order', ['count_acts' => $count_acts, 'order_id' => $this->order_id, 'action' => $action, 'controller' => $controller]);
    }

    private function getMenuOrderContent()
    {
        $order_id = $this->order_id;
        $item_id = $this->item_id;
        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;
        return $this->render('menu/content', compact('order_id', 'item_id', 'controller', 'action'));
    }



}

