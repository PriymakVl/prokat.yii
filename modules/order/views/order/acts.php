<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id, 'count_acts' => $count_acts])?>
    
    <!-- info message -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- list acts order -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="60">№ акта</th>
            <th width="60">год</th>
            <th width="90">месяц</th>
            <th width="90">позиций</th>
            <th width="60">кол-во</th>
            <th width="90">цена</th>
            <th >примечание</th>
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
                    <td>примечание какоето</td>
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
    <?=OrderMenuWidget::widget()?>
    <?=OrderActiveMenuWidget::widget()?>
    <?//=ListMenuWidget::widget()?>
</div>