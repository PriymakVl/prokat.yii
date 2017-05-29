<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppContentMenuWidget;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppTopMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=AppTopMenuWidget::widget(['app_id' => $app->id])?>
    
    <!-- info -->
    <div class="info-box">
        <span>Заявка:</span>&laquo; <?=$app->title?> &raquo;<br />
    </div>
    
    <!-- application item data -->
    <table>
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Данные указанные в заявке</td>
        </tr>
         <!-- name -->
        <tr>
            <td class="text-center">Название</td>
            <td>
                <?=$item->product->name?>    
            </td>
        </tr>
        <!-- count need -->
        <tr>
            <td class="text-center">Заказано</td>
            <td class="text-center">
                <?=$item->need?>
            </td>
        </tr>
        <!-- count rest -->
        <tr>
            <td class="text-center">Остаток</td>
            <td class="text-center">
                <?=$item->rest?>
            </td>
        </tr>
         <!-- count install -->
        <tr>
            <td class="text-center">В установке</td>
            <td class="text-center">
                <?=$item->product->install?>
            </td>
        </tr>
        <!-- delivery time -->
        <tr>
            <td class="text-center">Срок поставки</td>
            <td class="text-center">
                <?=$item->time ? $item->time : '<span style="color:red;">Не указан</span>'?>
            </td>
        </tr>
        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td>
                <?=$item->note?>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-center" style="color: green;">Дополнительные данные</td>
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
                    <a href="<?=Url::to(['/object/specification', 'obj_id' => $object->parent->id])?>"><?=$object->parent->name?></a>
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
    <?//=OrderContentMenuWidget::widget(['item_id' => $item->id, 'order_id' => $order->id])?>
    <?//=OrderMenuWidget::widget(['order_id' => $order->id])?>
</div>