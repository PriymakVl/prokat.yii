<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\order\models\Order;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\order\widgets\OrderListMenuWidget;
use app\modules\order\widgets\OrderTopListMenuWidget;
use app\modules\orderlist\widgets\OrderListListMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\orderact\widgets\OrderActListMenuWidget;

$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень заказов сортопрокатного стана</div>
    
    <!-- top nenu -->
    <?=OrderTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- data of order -->
    <table id="standart-list">
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
                        <a <? if ($order->state != Order::STATE_ACTIVE) echo 'style="color:red;"'?> href="<?=Url::to(['/order', 'order_id' =>$order->id])?>">
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
    <?=OrderActiveMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderListListMenuWidget::widget()?>
    <?=OrderActListMenuWidget::widget()?>
</div>