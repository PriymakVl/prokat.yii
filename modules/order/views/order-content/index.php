<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderContentMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
use app\modules\order\widgets\OrderTopMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info state of order -->
    <? if ($state == 'active'): ?>
        <div class="active-order">Активный заказ</div>
    <? endif; ?>
    
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
        <!-- item -->
        <? if ($item->item): ?>
            <tr>
                <td class="text-center">Позиция</td>
                <td>
                    <?=$item->item ? $item->item : '<span style="color:red;">Не указана</span>'?>
                </td>
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
        <? if ($object): ?>
            <!-- object code -->
            <tr>
                <td class="text-center">Код детали(узла)</td>
                <td>
                    <a href="<?=Url::to(['/object/drawing', 'obj_id' => $object->id])?>"><?=$object->code?></a>
                </td>
            </tr>
            <!--  object name -->
            <? if ($object->rus): ?>  
                <tr>
                    <td class="text-center">Наимен. детали(узла)</td>
                    <td>
                        <a href="<?=Url::to(['/object', 'obj_id' => $object->id])?>"><?=$object->rus?></a>
                    </td>
                </tr>
            <? endif; ?>
            <? if ($object->eng): ?>  
                <tr>
                    <td class="text-center">Name of detail(unit)</td>
                    <td>
                        <a href="<?=Url::to(['/object', 'obj_id' => $object->id])?>"><?=$object->eng?></a>
                    </td>
                </tr>
            <? endif; ?>
            <!--  object parent -->
            <tr>
                <td class="text-center">Входит в состав</td>
                <td>
                    <a href="<?=Url::to(['/object', 'obj_id' => $object->parent->id])?>"><?=$object->parent->name?></a>
                </td>
            </tr>
        <? endif; ?>
        <!-- file of drawing -->
        <? if ($item->file): ?>
            <tr>
                <td class="text-center">Файл чертежа</td>
                <td>
                    <? if ($item->pathDrawing): ?>
                        <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->file?></a>
                    <? elseif ($item->file): ?>
                        <?=$item->file?>
                    <? endif; ?>    
                </td>
            </tr>
        <? endif; ?>
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
    <?=OrderMenuWidget::widget(['order_id' => $order->id])?>
</div>