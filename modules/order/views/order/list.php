<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\order\widgets\OrderListMenuWidget;
use app\modules\order\widgets\OrderTopListMenuWidget;

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
                        <input type="checkbox" name="order" order_id="<?=$order->id?>" />
                    </td>
                    <td class="text-center">
                       <a href="<?=Url::to(['/order/content/list', 'order_id' =>$order->id])?>"><?=$order->number?></a>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/order', 'order_id' =>$order->id])?>"><?=$order->name?></a>
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
</div>