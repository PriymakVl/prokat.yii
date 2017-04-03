<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;

$this->registerCssFile('/css/order.css');
?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info state of order -->
    <? if ($state == 'active'): ?>
        <div class="active-order">Активный заказ</div>
    <? endif; ?>
    
    <!-- order data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <!-- number -->
        <tr>
            <td class="text-center">Номер заказа</td>
            <td <? if($order->number == 'черновик') echo 'style="color: red;"'; ?>>
                <? if ($order->content): ?>
                    <a href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>"><?=$order->number?></a>
                <? else: ?>
                    <?=$order->number?>
                <? endif; ?>    
            </td>
        </tr>
        <!-- name -->
        <tr>
            <td class="text-center">Наименование заказа</td>
            <td>
                <?=$order->name?>
            </td>
        </tr>
        <!-- mechanism -->
        <tr>
            <td class="text-center">Агрегат, механизм</td>
            <td>
                <?=$order->mechanism?>
            </td>
        </tr>
        <!-- unit -->
        <tr>
            <td class="text-center">Узел</td>
            <td>
                <?=$order->unit?>
            </td>
        </tr>
        <!-- type -->
        <tr>
            <td class="text-center">Статья затрат</td>
            <td>
                <?=$order->type?>
            </td>
        </tr>
        <!-- weight -->
        <tr>
            <td class="text-center">Вес заказа</td>
            <td>
                <?=$order->weight ? $order->weight.' кг' : '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <!-- service -->
        <tr>
            <td class="text-center">Служба</td>
            <td>
                <?=$order->service?>
            </td>
        </tr>
        <!-- customer -->
        <tr>
            <td class="text-center">Заказал</td>
            <td>
                <?=$order->customer?>
            </td>
        </tr>
        <!-- issuer -->
        <tr>
            <td class="text-center">Выдал</td>
            <td>
                <?=$order->issuer?>
            </td>
        </tr>
        <!-- date create -->
        <tr>
            <td class="text-center">Дата выдачи</td>
            <td>
                <?=$order->date?>
            </td>
        </tr>
        <!-- note -->
        <? if ($order->note): ?>
            <tr>
                <td class="text-center">Примечание</td>
                <td><?=$order->note?></td>
            </tr>
        <? endif; ?>

    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
    
    <?=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>