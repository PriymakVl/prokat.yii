<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\models\Order;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;

$this->registerCssFile('/css/order.css');
?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info state of order -->
    <? if ($session == 'active'): ?>
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
            <td>
                <? if ($order->content): ?>
                    <a <? if ($order->number == 'Не указан') echo 'style="color:red;"'?> href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>">
                        <?=$order->number?>
                    </a>
                <? else: ?>
                     <?=$order->number == 'Не указан' ? '<span style="color:red;">Не указан</span>' : $order->number?>
                <? endif; ?>   
            </td>
        </tr>
        <!-- state -->
        <tr>
            <td class="text-center">Состояние заказа</td>
            <td><?=$order->state?></td>
        </tr>
        <!-- state -->
        <tr>
            <td class="text-center">Период выдачи</td>
            <td><?=$order->period?></td>
        </tr>
        <!-- name -->
        <tr>
            <td class="text-center">Наименование заказа</td>
            <td>
                <?=$order->name?>
            </td>
        </tr>
        <!-- area -->
        <? if ($order->area): ?>
            <tr>
                <td class="text-center">Участок</td>
                <td><?=$order->area?></td>
            </tr>
        <? endif; ?>
        <!-- mechanism -->
        <tr>
            <td class="text-center">Агрегат, механизм</td>
            <td>
                <?=$order->mechanism == 'Не указан' ? '<span style="color:red;">Не указан</span>' : $order->mechanism?>
            </td>
        </tr>
        <!-- unit -->
        <tr>
            <td class="text-center">Узел</td>
            <td>
                <?=$order->unit == 'Не указан' ? '<span style="color:red;">Не указан</span>' : $order->unit?>
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
    
    <?=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
    
    <?=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>