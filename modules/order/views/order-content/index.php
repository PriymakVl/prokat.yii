<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;
use app\modules\order\widgets\OrderContentObjectWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
   <!-- info order is active -->
    <? if ($order->active): ?>
        <div class="alert alert-success margin-top-15">Активный заказ</div>
    <? endif; ?>
    
    <!-- info create of item order -->
    <?php if (Yii::$app->session->hasFlash('success-order-item')): ?>
      <div class="alert alert-success alert-dismissable margin-top-15">
          <?= Yii::$app->session->getFlash('success-order-item') ?>
      </div>
    <?php endif; ?>
    
    <!-- info -->
    <div class="info-box">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span><span <? if ($order->number == 'черновик') echo 'style="color:red;"'; ?>>&laquo; <?=$order->number?> &raquo;</span>
    </div>
    
    <!-- order item data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Данные указанные в заказном бланке</td>
        </tr>
        <!-- drawing -->
        <tr>
            <td class="text-center">Чертеж</td>
            <td>
                <? if ($item->pathDrawing): ?>
                    <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->drawing?></a>
                <? elseif ($item->drawing): ?>
                    <?=$item->drawing?>
                <? else: ?>
                    <span style="color:red;">Не указан</span>
                <? endif; ?>    
            </td>
        </tr>
        
        <!-- variant -->
        <? if ($item->variant): ?>
            <tr>
                <td class="text-center">Вариант</td>
                <td><?=$item->variant?></td>
            </tr>
        <? endif; ?>
        
        <!-- item -->
        <? if ($item->item): ?>
            <tr>
                <td class="text-center">Позиция</td>
                <td><?=$item->item?></td>
            </tr>
        <? endif; ?>
        
        <!-- name -->
        <tr>
            <td class="text-center">Наименование</td>
            <td>
                <? if ($item->obj_id): ?>
                    <a href="<?=Url::to(['/object', 'object_id' => $item->obj_id])?>"></a><?=$item->name?>
                <? else: ?>
                    <?=$item->name?>
                <? endif;?>
            </td>
        </tr>
        
        <!-- dimensions -->
        <tr>
            <td class="text-center">Габаритные размеры</td>
            <td>
                <?=$item->dimensions ? $item->dimensions : 'Не указаны'?>
            </td>
        </tr>
        
        <!-- count -->
        <tr>
            <td class="text-center">Количество</td>
            <td>
                <?=$item->count ? $item->count.' шт.' : '<span style="color:red;">Не указано</span>'?>
            </td>
        </tr>
        <!-- material -->
        <tr>
            <td class="text-center">Материал</td>
            <td>
                <?=$item->material ? $item->material : '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <!-- weight one -->
        <tr>
            <td class="text-center">Вес 1 детали(узла)</td>
            <td>
                <?=$item->weight ? $item->weight.' кг' : '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <!-- weight all-->
        <tr>
            <td class="text-center">Вес всех деталей(узлов)</td>
            <td>
                <?=$item->weightAll ? $item->weightAll.' кг' : '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <!-- delivery -->
        <? if ($item->delivery): ?>
            <tr>
                <td class="text-center">Доставка</td>
                <td>Доставляет заказчик</td>
            </tr>
        <? endif; ?>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Дополнительная информация</td>
        </tr>
        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td>
                <?=$item->note ? $item->note : 'Не указано'?>
            </td>
        </tr>
        
        <?=OrderContentObjectWidget::widget(['item' => $item])?>
        
        <!--  rating -->
        <tr>
            <td class="text-center">Рейтинг</td>
            <td><?=$item->rating?></td>
        </tr>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderContentMenuWidget::widget(['item_id' => $item->id, 'order_id' => $order->id])?>
    <?=ObjectSearchMenuWidget::widget()?>
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
</div>