<?php

use \yii\helpers\Url;
use app\modules\order\models\Order;

$this->registerJsFile('/js/order/order/order_list_print.js');
$this->registerJsFile('/js/order/orders/orders_delete.js');
$this->registerJsFile('/js/order/orders/orders_update.js');
$this->registerJsFile('/js/order/orders/orders_set_active.js');

?>
<div  class="sidebar-menu">
    <h5>Перечень заказов</h5>   
    <ul >
        <li>
            <a href="<?=Url::to(['/order/form'])?>">Выдать заказ</a>
        </li>
        <li>
            <a href="#" id="order-update">Редактировать заказ</a>
        </li>
        <li>
            <a href="#" id="order-delete">Удалить заказ</a>
        </li>
        <li>
            <a href="#" id="order-active">Сделать заказ активным</a>
        </li>
        <li>
            <a href="<?=Url::to(['/orders', 'kind' => Order::KIND_PERMANENT, 'period' => Order::PERIOD_ALL])?>">Постоянно действующ.</a>
        </li>
        <li>
            <a href="<?=Url::to(['/orders', 'state' => Order::STATE_DRAFT, 'period' => Order::PERIOD_ALL])?>">Черновики</a>
        </li>
        <li>
            <a href="#" onclick="return false;" id="order-list-print">Распечатать перечень</a>    
        </li> 
    </ul>
</div>