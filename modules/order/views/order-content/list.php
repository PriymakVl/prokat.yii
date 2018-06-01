<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\widgets\ShowNoteWidget;

$this->registerCssFile('/css/order.css');
$this->registerJsFile('/js/order/content/content_list_pagination.js');
$this->registerJsFile('/js/order/content/change_dwg_on_object.js');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderMenuWidget::widget(['type' => 'top-order', 'order_id' => $order->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
        <input type="hidden" id="order-id" value="<?=$order->id?>"/>
    </div>
    
    <!-- info state of order -->
    <? if ($order->active): ?>
        <div class="alert alert-success margin-top-15 message-wrp">
            <span>Активный заказ</span>
            <span class="glyphicon glyphicon-remove" title="Закрыть"></span>
        </div>
    <? endif; ?>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- page box -->
    <? if (count($content) > 10): ?>
        <div id="page-content-wrp" class="margin-top-15 info-box">
            <a id="page-all" class="top-menu-active-link" href="#" onclick="return false;">Показать все</a><span>|</span>
            <a id="page-1" href="#" page="1" onclick="return false;">Страница 1</a><span>|</span>
            <a id="page-2" href="#" page="2" onclick="return false;">Страница 2</a><span>|</span>
            <? if (count($content) > 20) echo '<a id="page-3" href="#" page="3" onclick="return false;">Страница 3</a><span>|</span>'?>
            <? if (count($content) > 30) echo '<a id="page-4" href="#" page="4" onclick="return false;">Страница 4</a><span>|</span>'?>
            <? if (count($content) > 40) echo '<a id="page-5" href="#" page="5" onclick="return false;">Страница 5</a><span>|</span>'?>
            <? if (count($content) > 50) echo '<a id="page-6" href="#" page="5" onclick="return false;">Страница 6</a><span>|</span>'?>
        </div>
    <? endif; ?>
    
    <!-- order content -->
    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="150">
                <a href="#" id="change-dwg-object">Чертеж</a>
            </th>
            <th width="50">Поз.</th>
            <th width="305">Наименование</th>
            <th width="50">Заказ.</th>
            <th width="50">Получ.</th>
            <th width="85">Матер.</th>
        </tr>
        <? if ($content): ?>
            <? $number = 1; ?>
            <? foreach ($content as $item): ?>
                <tr <? if ($item->children) echo 'class="item-parent"'; ?>>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" number="<?=$number?>" order_id="<?=$order->id?>"/>
                    </td>
                    <!-- drawing -->
                    <td class="text-center">
                        <span class="drawing-wrp">
                            <? if ($item->pathDrawing): ?>
                                <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->drawing?></a>
                            <? elseif ($item->drawing): ?>
                                <?=$item->drawing?>
                            <? else: ?>
                                <span style="color:red;">Не указан</span>
                            <? endif; ?>
                        </span>
                        <span class="object-wrp" style="display: none">
                            <? if ($item->code): ?>
                                <a href="<?=Url::to(['/search/object/code', 'code' => $item->code])?>"><?=$item->code?></a>
                            <? else: ?>
                                <span class="red">Не указан</span>
                            <? endif; ?>
                        </span>

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
                        <a href="<?=Url::to(['/order/content/index', 'item_id' => $item->id])?>"><?=$item->name?></a>
                        <?=$item->delivery ? '<span> (Доставляет заказчик)</span>' : '' ?>
                        <? if ($item->note && !$item->delivery): ?>
                            <?=ShowNoteWidget::widget(['note' => $item->note, 'lengthMax' => 25, 'suffix' => ''])?>
                        <? endif; ?>
                        <br /><span><?=$item->dimensions?></span>
                    </td>

                    <!-- number of ordered -->
                    <td class="text-center">
                        <?=$item->count ? $item->count : '<span style="color:red;">Нет</span>'?>
                    </td>

                    <!-- number of received -->
                    <td class="text-center">
                        <?=$item->numberReceived?>
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
    <?=OrderMenuWidget::widget(['type' => 'order-content', 'order_id' => $order->id])?>
     <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['type' => 'order', 'order_id' => $order->id])?>
    <? //if (!$order->active) echo OrderActiveMenuWidget::widget(['order_id' => $order->id]); ?>
</div>