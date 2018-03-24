<?php

use yii\widgets\ActiveForm;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\order\models\Order;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\order\widgets\OrderListMenuWidget;
use app\modules\order\widgets\OrderTopListFiltersWidget;
//use app\modules\orderlist\widgets\OrderListListMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
//use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\order\widgets\OrderSortEquipmentMenuWidget;

$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <a href="<?=Url::to('/order/show/filters')?>" id="show-filters">Фильтры</a>
        <span>Перечень заказов сортопрокатного стана</span>.
    </div>
    
    <!-- top nenu -->
    <?=OrderTopListFiltersWidget::widget(['params' => $params])?>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- data of order -->
    <table id="standart-list" class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="90">№ заказа</th>
            <th width="440">Наименование</th>
            <th width="160">Заказал</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $order): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order" id="order-id" order_id="<?=$order->id?>" />
                    </td>
                    <td class="text-center">
                       <? if ($order->content): ?>
                            <a <? if ($order->number == 'Не указан') echo 'style="color:red;"'?> href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>">
                                <?=$order->number?>
                            </a>
                        <? else: ?>
                            <?=$order->number == 'Не указан' ? '<span style="color:red;">Не указан</span>' : $order->number?>
                        <? endif; ?>  
                    </td>
                    <td>
                        <a <? if ($order->state == Order::STATE_DRAFT || $order->state == Order::STATE_CLOSED || $order->state == Order::STATE_NOT_ACCEPTED) echo 'style="color:red;"'?> href="<?=Url::to(['/order', 'order_id' =>$order->id])?>">
                            <?=$order->name?>
                        </a>
                    </td>
                    <td>
                        <?=$order->customer?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Заказов нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderListMenuWidget::widget(['state' => $state])?>
    <? if ($order->active) echo OrderActiveMenuWidget::widget(); ?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?//=OrderSortEquipmentMenuWidget::widget()?>
     <?=OrderActiveMenuWidget::widget()?>
    <?//=OrderListListMenuWidget::widget()?>
    <?//=OrderActListMenuWidget::widget()?>
</div>