<?php

use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
//use app\modules\orderlist\widgets\OrderListListMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;

$this->registerCssFile('/css/product.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень изготовленного для детали/узла</div>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        Наименование детали/узла: DDDDDDDDDDD
        Код детали/узла: 999999
    </div>
    
    <!-- top nenu -->
    <?//=OrderTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- flash error message -->
    <?php if (Yii::$app->session->hasFlash('error')): ?>
       <div class="alert alert-danger margin-top-15">
            <?= \Yii::$app->session->getFlash('error') ?>
       </div>
    <?php endif; ?>
    
    <!-- data product -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="product" id="checked-all" />
            </th>
            <th width="90">№ Акта</th>
            <th width="90">№ Заказа</th>
            <th width="90">Месяц</th>
            <th width="90">Год</th>
            <th width="90">Количество</th>
        </tr>
        <? if ($items): ?>
            <? foreach ($items as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="product" id="product" item_id="<?=$item->id?>" />
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/order/act', 'act_id' => $item->act->id])?>"><?=$item->act->number?></a> 
                    </td>
                    <td>
                        <a href="<?=Url::to(['/order', 'order_id' => $item->order->id])?>"><?=$item->order->number?></a>
                    </td>
                    <td>
                        <?=$item->act->month?>
                    </td>
                    <td>
                        <?=$item->act->year?>
                    </td>
                    <td>
                        <?=$item->count?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Изготовлений нет</td>
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
    <?=OrderSortEquipmentMenuWidget::widget()?>
     <?=OrderActiveMenuWidget::widget()?>
    <?//=OrderListListMenuWidget::widget()?>
    <?//=OrderActListMenuWidget::widget()?>
</div>