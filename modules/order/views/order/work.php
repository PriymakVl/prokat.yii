<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderMenuWidget::widget(['type' => 'top-order', 'order_id' => $order->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span>&laquo; <?=$order->number?> &raquo;
    </div>
    
    <!-- order work -->
    <table class="order-work margin-top-15">
        <tr>
            <th width="725">Характер работы</th>
        </tr>
            <tr>
                <td <? if (!$order->work) echo 'class="not-content"'; ?> class="order-work">
                    <?=$order->work ? $order->work : 'Не указан'?>
                </td>
            </tr>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['type' => 'order', 'order_id' => $order->id])?>
</div>