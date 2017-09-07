<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;
use app\modules\order\widgets\OrderItemChildrenWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
        <input type="hidden" id="order-id" value="<?=$order->id?>"/>
    </div>
    
    <!-- info state of order -->
    <? if ($order->active): ?>
        <div class="alert alert-success margin-top-15">Активный заказ</div>
    <? endif; ?>
    
    <!-- order content -->
    <table>
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="150">Чертеж</th>
            <th width="50">Поз.</th>
            <th width="355">Наименование</th>
            <th width="50">Колич.</th>
            <th width="85">Матер.</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $item): ?>
                <tr <? if ($item->children) echo 'class="item-parent"'; ?>>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" />
                    </td>
                    <!-- drawing -->
                    <td class="text-center">
                        <? if ($item->pathDrawing): ?>
                            <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->drawing?></a>
                        <? elseif ($item->drawing): ?>
                            <?=$item->drawing?>
                        <? else: ?>
                            <span style="color:red;">Не указан</span>
                        <? endif; ?>
                    </td>
                    
                    <!-- item -->
                    <td class="text-center">
                        <? if ($item->children && !$item->item): ?>
                            <span>СБ</span>
                        <? else: ?>
                            <?=$item->item?>
                        <? endif; ?>
                    </td>
                    
                    <!-- name -->
                    <td>
                        <a href="<?=Url::to(['/order/content/item', 'item_id' => $item->id])?>"><?=$item->name?></a>
                        <?=$item->delivery ? '<span> (Доставляет заказчик)</span>' : '' ?>
                        <br /><span><?=$item->dimensions?></span>
                    </td>
                    
                    <!-- count -->
                    <td class="text-center">
                        <?=$item->count ? $item->count : '<span style="color:red;">Нет</span>'?>
                    </td>
                    
                    <!-- material -->
                    <td class="text-center">
                        <?=$item->material ? $item->material : '<span style="color:red;">Нет</span>'?>
                    </td>
                </tr>
                <? if ($item->children): ?>
                    <?=OrderItemChildrenWidget::widget(['parent' => $item])?>
                <? endif ?>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Содержимого заказа еще нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
     <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
    <? if (!$order->active) echo OrderActiveMenuWidget::widget(['order_id' => $order->id]); ?>
</div>