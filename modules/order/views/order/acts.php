<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\models\Order;
use app\modules\order\widgets\OrderActiveMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderMenuWidget::widget(['type' => 'top-order', 'order_id' => $order->id])?>
    
    <!-- info message -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- list acts order -->
    <table class="margin-top-15" id="table-order-acts">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="60">№ акта</th>
            <th width="60">год</th>
            <th width="90">месяц</th>
            <th width="90">позиций</th>
            <th width="60">кол-во</th>
            <th width="95">цена</th>
            <th >
                <?=$order->kind == Order::KIND_PERMANENT ? 'заказал' : 'примечание'?>
            </th>
        </tr>
        <? if ($acts): ?>
            <? foreach ($acts as $act): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order-act" act_id="<?=$act->id?>" />
                    </td>
                    <td class="text-center">
                        <a  style="color:<?=$act->colorState?>" href="<?=Url::to(['/order/act', 'act_id' =>$act->id])?>"><?=$act->number?></a>
                    </td>
                    <td class="text-center">
                         <?=$act->year?>   
                    </td>
                    <td class="text-center">
                        <?=$act->month?>
                    </td>
                    <td class="text-center">
                        <?=$act->countPosition?>
                    </td>
                    <td class="text-center">
                        <?=$act->countItems?>
                    </td>
                    <td class="text-center">
                        <?= $act->cost ? $act->cost.'грн.' : 'Не указана'?>
                    </td>
                    <td>
                        <? if ($order->kind == Order::KIND_PERMANENT): ?>
                            <?=$act->customer ? $act->customer : 'Не указан' ?>
                        <? else: ?>
                            <?=$act->note?>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="8" class="not-content">Актов еще нет</td>
            </tr>
        <? endif; ?>
    </table>
    
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['type' => 'order', 'order_id' => $order->id])?>
    <?//=OrderActiveMenuWidget::widget()?>
</div>