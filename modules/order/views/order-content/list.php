<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;

$this->registerCssFile('/css/order.css');
$this->registerJsFile('js/order/item_list_delete.js', ['depends' => JqueryAsset::className()]);

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info state of order -->
    <? if ($state == 'active'): ?>
        <div class="active-order">Активный заказ</div>
    <? endif; ?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
        <input type="hidden" id="order-id" value="<?=$order->id?>"/>
    </div>
    
    <!-- order content -->
    <table>
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="200">Чертеж</th>
            <th width="355">Наименование</th>
            <th width="50">Колич.</th>
            <th width="85">Матер.</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" />
                    </td>
                    <!-- drawing -->
                    <td class="text-center">
                        <? if ($item->file && $item->cat_dwg && $item->drawing): ?>
                            <a target="_blank" href="<?=Url::to(['/files/'.$item->cat_dwg.'/'.$item->file])?>"><?=$item->drawing?></a>
                        <? elseif ($item->drawing): ?>
                            <?=$item->drawing?>
                        <? else: ?>
                            <span style="color:red;">Не указан</span>
                        <? endif; ?>
                    </td>
                    
                    <!-- name -->
                    <td>
                        <a href="<?=Url::to(['/order/content/item', 'item_id' => $item->id])?>"><?=$item->name?></a>
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
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Содержимого заказа еще нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderContentMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
</div>