<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
//use app\modules\order\widgets\OrderMenuWidget;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\orderact\widgets\OrderActTopListMenuWidget;
//use app\modules\orderlist\widgets\ListMenuWidget;

//$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <a href="<?=Url::to('/order/act/list')?>">Акты</a>
        <span>Перечень деталей по актам за </span>
        <strong><?=$period?></strong>
    </div>
    
    <!-- top nenu -->
    <?=OrderActTopListMenuWidget::widget(['params' => $params, 'acts' => false])?>
    
    <!-- info message -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- list akt orders -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="60">№ акта</th>
            <th width="80">№ заказа</th>
            <th width="180">Оборудование</th>
            <th width="180">Деталь</th>
            <th width="75">Кол-во</th>
            <th width="120">Принявший</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="detail" item_id="<?=$item->id?>" />
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/order/act', 'act_id' =>$item->act->id])?>"><?=$item->act->number?></a>
                    </td>
                    <td class="text-center">
                         <a href="<?=Url::to(['/order/content/list', 'order_id' => $item->order->id])?>"><?=$item->order->number?></a>    
                    </td>
                    <td>
                        Оборудование
                    </td>
                    <td>
                        <?=$item->item->name ? $item->item->name : 'Не указано'?>
                    </td>
                    <td class="text-center">
                        <?=$item->count ? $item->count : 'Не указано'?>
                    </td>
                    <td>
                        <?=$act->order->customer ? $act->order->customer : 'Не указан'?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="7" class="not-content">Актов еще нет</td>
            </tr>
        <? endif; ?>
    </table>
    
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderActListMenuWidget::widget()?>
    <?//=OrderActiveMenuWidget::widget()?>
    <?//=ListMenuWidget::widget()?>
</div>