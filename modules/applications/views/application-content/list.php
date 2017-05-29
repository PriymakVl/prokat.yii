<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppTopMenuWidget;
use app\modules\applications\widgets\AppContentMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=AppTopMenuWidget::widget(['app_id' => $app->id])?>
    
    <!-- info state of order -->
    <? if ($state == 'active'): ?>
        <div class="active-order">Активный заказ</div>
    <? endif; ?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название заказа:</span>&laquo; <?=$app->title?> &raquo;<br />
        <input type="hidden" id="order-id" value="<?=$app->id?>"/>
    </div>
    
    <!-- application content -->
    <table>
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="460">Наименование</th>
            <th width="60">Кол-во</th>
            <th width="170">Примечание</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" />
                    </td>
                    <td>
                        <a href="<?=Url::to(['/application/content/item', 'item_id' => $item->id])?>"><?=$item->product->name?></a>
                    </td>
                    <td class="text-center">
                        <?=$item->need?>
                    </td>
                    <td>
                       <?=$item->note?> 
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Содержимого заявки еще нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?//=AppContentMenuWidget::widget(['order_id' => $order->id])?>
    <?//=AppMenuWidget::widget(['app_id' => $app->id])?>
</div>