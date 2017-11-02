<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;
use app\modules\order\widgets\OrderItemChildrenWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;

$this->registerCssFile('/css/order.css');
$this->registerJsFile('/js/order/content_list_pagination.js');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
        <input type="hidden" id="order-id" value="<?=$order->id?>"/>
    </div>
    
    <!-- info state of order -->
    <? if ($order->active): ?>
        <div class="alert alert-success margin-top-15">Активный заказ</div>
    <? endif; ?>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- page box -->
    <? if (count($content) > 10): ?>
        <div id="page-content-wrp" class="margin-top-15">
            <a id="page-all" class="top-menu-active-link" href="#" onclick="return false;">Показать все</a>
            <a id="page-1" href="#" page="1" onclick="return false;">Страница 1</a>
            <a id="page-2" href="#" page="2" onclick="return false;">Страница 2</a>
            <? if (count($content) > 20) echo '<a id="page-3" href="#" page="3" onclick="return false;">Страница 3</a>'?>
            <? if (count($content) > 30) echo '<a id="page-4" href="#" page="4" onclick="return false;">Страница 4</a>'?>
            <? if (count($content) > 40) echo '<a id="page-5" href="#" page="5" onclick="return false;">Страница 5</a>'?>
            <? if (count($content) > 50) echo '<a id="page-6" href="#" page="5" onclick="return false;">Страница 6</a>'?>
        </div>
    <? endif; ?>
    
    <!-- order content -->
    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="150">Чертеж</th>
            <th width="50">Поз.</th>
            <th width="355">Наименование</th>
            <th width="50">Колич.</th>
            <th width="85">Матер.</th>
        </tr>
        <? if ($content): ?>
            <? $number = 1; ?>
            <? foreach ($content as $item): ?>
                <tr <? if ($item->children) echo 'class="item-parent"'; ?>>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" number="<?=$number?>" />
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
                    <td class="text-center" <? if ($item->parent_id != 0) echo 'style="background:yellow;"' ?>>
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
                        <? if ($item->material && $item->material_add): ?>
                            <?=$item->material.'<br>'.$item->material_add?>
                        <? elseif ($item->material): ?>
                            <?=$item->material?>
                        <? else: ?>
                            <span style="color:red;">Нет</span>
                        <? endif; ?>
                    </td>
                </tr>
                <? $number++ ?>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Содержимого заказа еще нет</td>
            </tr>
        <? endif; ?>
    </table>
    
    <!-- note -->
    <? if ($order->note): ?>
    <p class="header-note">Примечание:</p>
    <div class="info-box" style="width:720px">
        <?=$order->note?>
    </div>
    <? endif; ?>
    
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
     <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
    <? if (!$order->active) echo OrderActiveMenuWidget::widget(['order_id' => $order->id]); ?>
</div>