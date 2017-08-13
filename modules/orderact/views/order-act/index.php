<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
//use app\modules\orderlist\models\OrderList;
use app\modules\orderact\widgets\OrderActMenuWidget;
//use app\modules\order\widgets\OrderActiveMenuWidget;
use app\modules\orderact\widgets\OrderActTopMenuWidget;
//use app\modules\order\widgets\OrderContentMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderActTopMenuWidget::widget(['act_id' => $act->id])?>
    
    <!-- info active act -->
    <? if ($act->active): ?>
        <div class="alert alert-success active-order">Активный акт</div>
    <? endif; ?>
    
    <!-- info create of act order -->
    <?php if (Yii::$app->session->hasFlash('success-order-act')): ?>
      <div class="alert alert-success alert-dismissable margin-top-15">
          <?= Yii::$app->session->getFlash('success-order-act') ?>
      </div>
    <?php endif; ?>
    
    <!-- order act data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <!-- number -->
        <tr>
            <td class="text-center">Номер акта</td>
            <td><?=$act->number?></td>
        </tr>
        
        <!-- Цех(участок) -->
        <tr>
            <td class="text-center">Цех(участок)</td>
            <td>
                <?=$act->department?>
            </td>
        </tr>
        
        <!-- number of order -->
        <tr>
            <td class="text-center">Номер заказа</td>
            <td>
                <a href="<?=Url::to(['/order', 'order_id' => $act->order_id])?>"><?=$act->order->number?></a>
            </td>
        </tr>
        
        <!-- customer -->
        <tr>
            <td class="text-center">Заказал</td>
            <td>
                <?=$act->order->customer?>
            </td>
        </tr>
        
        <!-- cost -->
        <tr>
            <td class="text-center">Себестоимость</td>
            <td>
                <?=$act->cost.'грн'?>
            </td>
        </tr>
        
        <!-- time -->
        <tr>
            <td class="text-center">Нормо часы</td>
            <td>
                <?=$act->time?>
            </td>
        </tr>
        
        <!-- date of create-->
        <tr>
            <td class="text-center">Дата создания</td>
            <td><?=date('d.m.y', $act->date_creat)?></td>
        </tr>
        
        <!-- date of registration -->
        <tr>
            <td class="text-center">Дата рагистрации</td>
            <td><?=date('d.m.y', $act->date_regist)?></td>
        </tr>
        
        <!-- date of passed -->
        <tr>
            <td class="text-center">Дата сдачи</td>
            <td><?=date('d.m.y', $act->date_pass)?></td>
        </tr>
        
        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td><?=$act->note?></td>
        </tr>

    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=OrderActMenuWidget::widget(['act' => $act])?>
    
    <?//=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
    
    <?//=OrderActiveMenuWidget::widget(['order_id' => $order->id])?>
</div>