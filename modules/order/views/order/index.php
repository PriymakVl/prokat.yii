<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\widgets\OrderContentMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentObjectWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->>
    <?=OrderMenuWidget::widget(['type' => 'top-order', 'order_id' => $order->id])?>
    
   <!-- info order is active -->
    <? if ($order->active): ?>
        <div class="alert alert-success margin-top-15 message-wrp">
            <span>Активный заказ</span>
            <span class="glyphicon glyphicon-remove" title="Закрыть"></span>
        </div>
    <? endif; ?>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
    </div>
    
    <!-- order data -->
    <table class="margin-top-15">
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
        
        <!-- kind -->
        <tr>
            <td class="text-center">Вид заказа</td>
            <td><?=$order->kind?></td>
        </tr>
         	
        <!-- period -->
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
	
        <!-- location (section + equipment + unit) -->
        <? if ($order->location): ?>
            <tr>
                <td class="text-center">Оборудование</td>
                <td><?=$order->location?></td>
            </tr>
        <? endif; ?>

        <!-- Group equipmens -->
        <? if ($order->locationGroup): ?>
            <tr>
                <td class="text-center">Группа оборудования</td>
                <td><?=$order->locationGroup?></td>
            </tr>
        <? endif; ?>
        
        <!-- inventory -->
        <tr>
            <td class="text-center">Инвентар. номер</td>
            <td>
                <?=$order->inventory ? $order->inventory : '<span style="color:red;">Не указан</span>'?>
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
    <?//=OrderContentMenuWidget::widget(['item_id' => $item->id, 'order_id' => $order->id])?>
    <?=OrderMenuWidget::widget(['type' => 'order-content', 'order_id' => $order->id, 'item_id' => $item->id])?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['type' => 'order', 'order_id' => $order->id])?>
    <?//=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>