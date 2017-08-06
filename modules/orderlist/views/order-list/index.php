<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
//use app\modules\orderlist\models\OrderList;
//use app\modules\orderlist\widgets\OrderMenuWidget;
//use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\orderlist\widgets\OrderListTopMenuWidget;
//use app\modules\order\widgets\OrderContentMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderListTopMenuWidget::widget(['list_id' => $list->id])?>
    
    <!-- info state of order -->
    <? if ($session == 'order-list-active'): ?>
        <div class="alert alert-success active-order">Активный список заказов</div>
    <? endif; ?>
    
    <!-- info create of list order -->
    <?php if (Yii::$app->session->hasFlash('success-order-list')): ?>
      <div class="alert alert-success alert-dismissable">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <?= Yii::$app->session->getFlash('success-order-list') ?>
      </div>
    <?php endif; ?>
    
    <!-- order list data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <? if ($out_num): ?>
            <!-- out_num -->
            <tr>
                <td class="text-center">Исходящий</td>
                <td><?=$list->out_num?></td>
            </tr>
            <!-- out_date -->
            <tr>
                <td class="text-center">Дата регистрации</td>
                <td><?=date('d.m.y', $list->out_date)?></td>
            </tr>
        <? endif; ?>
        
        <!-- name -->
        <tr>
            <td class="text-center">Наименование</td>
            <td><?=$list->name?></td>
        </tr>

        <!-- type -->
        <tr>
            <td class="text-center">Статья затрат</td>
            <td>
                <?=$list->type?>
            </td>
        </tr>
        
        <!-- date create -->
        <tr>
            <td class="text-center">Дата создания</td>
            <td>
                <?=date('d.m.y', $list->created)?>
            </td>
        </tr>
        
        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td><?=$list->note?></td>
        </tr>

    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?//=OrderMenuWidget::widget(['order_id' => $order->id])?>
    
    <?//=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
    
    <?//=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>