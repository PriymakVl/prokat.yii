<?php

use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
//use app\modules\order\models\Order;
//use app\modules\order\widgets\OrderMenuWidget;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\orderact\widgets\OrderActTopListMenuWidget;
//use app\modules\orderlist\widgets\ListMenuWidget;

//$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень актов за <strong><?=$period?></strong></div>
    
    <!-- top nenu -->
    <?=OrderActTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- info message -->
    <? $messages = ['danger', 'success', 'warning']; ?>
    <? foreach ($messages as $message): ?>
        <?php if (\Yii::$app->session->hasFlash($message)): ?>
          <div class="alert alert-<?=$message?> margin-top-15">
              <?= \Yii::$app->session->getFlash($message) ?>
          </div>
        <?php endif; ?>
    <? endforeach; ?>
    
    <!-- list akt orders -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="60">№ акта</th>
            <th width="80">№ заказа</th>
            <th width="355">Наименование заказа</th>
            <th width="80">Себ-ть</th>
            <th width="120">Принявший</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $act): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order-act" act_id="<?=$act->id?>" />
                    </td>
                    <td class="text-center">
                        <a  style="color:<?=$act->colorState?>" href="<?=Url::to(['/order/act', 'act_id' =>$act->id])?>"><?=$act->number?></a>
                    </td>
                    <td class="text-center">
                         <a href="<?=Url::to(['/order/content/list', 'order_id' => $act->order->id])?>"><?=$act->order->number?></a>    
                    </td>
                    <td>
                        <a href="<?=Url::to(['/order', 'order_id' => $act->order->id])?>"><?=$act->order->name?></a> 
                    </td>
                    <td class="text-center">
                        <?= $act->cost ? $act->cost.'грн.' : 'Не указана'?>
                    </td>
                    <td>
                        <?=$act->order->customer ? $act->order->customer : 'Не указан'?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="5" class="not-content">Актов еще нет</td>
            </tr>
        <? endif; ?>
    </table>
    
    <!-- month cost -->
    <? if ($costs): ?>
        <table class="margin-top-15">
            <tr>
                <td width="300">Общая себестоимость</td>
                <td><?=$costs['all'].'грн'?></td>
            </tr>
            <? if ($costs['make']): ?>
                <tr>
                    <td width="300">Cебестоимость изготовления</td>
                    <td><?=$costs['make'].'грн'?></td>
                </tr>
            <? endif; ?>
            <? if ($costs['current']): ?>
                <tr>
                    <td width="300">Cебестоимость текущего ремонта</td>
                    <td><?=$costs['current'].'грн'?></td>
                </tr>
            <? endif; ?>
           <? if ($costs['capital']): ?>
                <tr>
                    <td width="300">Cебестоимость кап. ремонта</td>
                    <td><?=$costs['capital'].'грн'?></td>
                </tr>
            <? endif; ?> 
            <? if ($costs['enhancement']): ?>
                <tr>
                    <td width="300">Cебестоимость улучшения</td>
                    <td><?=$costs['enhancement'].'грн'?></td>
                </tr>
            <? endif; ?> 
        </table>
    <? endif; ?>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderActListMenuWidget::widget()?>
    <?//=OrderActiveMenuWidget::widget()?>
    <?//=ListMenuWidget::widget()?>
</div>