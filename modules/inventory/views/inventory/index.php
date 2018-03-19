<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\inventory\widgets\InventoryMenuWidget;

$this->registerCssFile('/css/inventory.css');

?>
<div class="content">
    
    <!-- title -->
    <div class="title-box">Данные инвентарного номера</div>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- inventory data -->
    <table class="margin-top-15">
        <tr>
            <th width="180">Наименование</th>
            <th width="545">Значение</th>
        </tr>
        <!-- number -->
        <tr>
            <td class="text-center">Инвентарный номер</td>	
            <td><?=$inv->number?></td>
        </tr>
         	
        <!-- name -->
        <tr>
            <td class="text-center">Наименование</td>
            <td><?=$inv->name?></td>
        </tr>
        
        <!-- категория -->
        <tr>
            <td class="text-center">Категория</td>
            <td><?=$inv->category?></td>
        </tr>
         	
        <!-- Code -->
        <tr>
            <td class="text-center">Код объекта</td>
            <td>
                <? if ($inv->obj): ?>
                    <a href="<?=Url::to(['/object', 'obj_id' => $inv->obj-id])?>"><?=$inv->obj->code ? $inv->obj->code : '<span>Код указан</span>'?></a>
                <? else: ?>
                    <span>Не указан</span>
                <? endif; ?>
            </td>
        </tr>

        <!-- note -->
        <tr>
            <td class="text-center">Примечание</td>
            <td><?=$inv->note?></td>
        </tr>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=InventoryMenuWidget::widget(['inv' => $inv])?>
</div>