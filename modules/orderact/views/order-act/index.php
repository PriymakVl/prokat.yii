<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\orderact\widgets\OrderActMenuWidget;
//use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\orderact\widgets\OrderActTopMenuWidget;
use app\modules\orderact\widgets\OrderActContentMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- info box -->
    <div class="info-box text-center"><strong>Акт работ выполненных по заказу </strong></div>
    
    <!-- info active act -->
    <? if ($act->active): ?>
        <div class="alert alert-success active-order">Активный акт</div>
    <? endif; ?>
    
    <!-- info message -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- order act data -->
    <table class="margin-top-15">
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <!-- number -->
        <tr>
            <td class="text-center">Номер акта</td>
            <td><?=$act->number?></td>
        </tr>
        
        <!-- state -->
        <tr>
            <td class="text-center">Состояние акта</td>
            <td><?=$act->state?></td>
        </tr>
        
        <!-- number of order -->
        <tr>
            <td class="text-center">Номер заказа</td>
            <td>
                <? if ($act->order): ?>
                    <a href="<?=Url::to(['/order/content/list', 'order_id' => $act->order_id])?>"><?=$act->order->number?></a>
                <? else: ?>
                    <?=$act->order_num?>
                <? endif; ?>
            </td>
        </tr>
        
        <!-- name of order -->
        <tr>
            <td class="text-center">Название заказа</td>
            <td>
                <a href="<?=Url::to(['/order', 'order_id' => $act->order_id])?>"><?=$act->order->name?></a>
            </td>
        </tr>
        
        <!-- inventory number -->
        <tr>
            <td class="text-center">Инв. номер</td>
            <td><?=$act->order->inventory ? $act->order->inventory : 'Не указан'?></td>
        </tr>
        
        <!-- Цех(участок) -->
        <tr>
            <td class="text-center">Цех(участок)</td>
            <td>
                <?=$act->department ? $act->department : 'Не указан'?>
            </td>
        </tr>
        
        <!-- customer -->
        <tr>
            <td class="text-center">Принял</td>
            <td>
                <?=$act->order->customer?>
            </td>
        </tr>
        
        <!-- cost -->
        <tr>
            <td class="text-center">Себестоимость</td>
            <td>
                <?=$act->cost ? $act->cost.'грн' : 'Не указана'?>
            </td>
        </tr>
        
        <!-- time -->
        <tr>
            <td class="text-center">Нормо часы</td>
            <td>
                <?=$act->working_hour?>
            </td>
        </tr>
        
        <!-- date of create-->
        <tr>
            <td class="text-center">Период оформления</td>
            <td><?=$act->period ? $act->period : '<span style="color:red;">Не указан</span>'?></td>
        </tr>
        
        <!-- date of registration -->
        <tr>
            <td class="text-center">Дата регистрации</td>
            <td><?=date('d.m.y', $act->date_registr).'г.'?></td>
        </tr>
        
        <!-- date of passed -->
        <? if ($act->date_pass): ?>
            <tr>
                <td class="text-center">Дата сдачи</td>
                <td><?=date('d.m.y', $act->date_pass)?></td>
            </tr>
        <? endif; ?>
        
        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td><?=$act->note?></td>
        </tr>

    </table>
    
    <? if($content): ?>
        <table class="margin-top-15">
            <tr>
                <th width="30"><input type="radio" name="order-act-item" id="checked-all" disabled="disabled" /></th>
                <th width="100">Чертеж</th>
                <th>Наименование</th>
                <th width="70">Кол-во</th>
                <th width="70">Вес акт</th>
                <th width="80">Вес заказ</th>
            </tr>
            <? foreach ($content as $item): ?>
                <tr>
                    <td><input type="radio" name="order-act-item" item_id="<?=$item->id?>" act_id="<?=$item->act_id?>"/></td>
                    <td class="text-center">
                        <? if ($item->item->pathDrawing): ?>
                            <a target="_blank" href="<?=Url::to([$item->item->pathDrawing])?>"><?=$item->item->drawing?></a>
                        <? else: ?>
                            <?=$item->item->drawing?>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if ($item->item->code): ?>
                            <a target="_blank" href="<?=Url::to(['/product', 'code' => $item->item->code])?>"><?=$item->item->name?></a>
                        <? else: ?>
                            <?=$item->item->name?>
                        <? endif; ?>
                    </td>
                    <td class="text-center"><?=$item->count?></td>
                    <? if ($item->weight && $item->item->weight && ($item->weight > $item->item->weight)) $highlite_weight = true ?>
                    <td class="text-center" <? if ($highlite_weight) echo 'style="color:red;"';?>><?=$item->weight?></td>
                    <td class="text-center"><?=$item->item->weight?></td>
                </tr>
            <? endforeach; ?>
        </table>
    <? endif; ?>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=OrderActMenuWidget::widget(['act' => $act])?>
    
    <?=OrderActContentMenuWidget::widget(['act' => $act])?>
    
    <?//=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>