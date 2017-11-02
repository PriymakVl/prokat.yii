<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\product\widgets\ProductTopMenuWidget;


$this->registerCssFile('/css/order.css');
$this->registerJsFile('/js/order/content_list_pagination.js');

?>
<div class="content">
    <!-- top nenu -->
    <?//=ProductTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название детали:</span>&laquo; <?=$obj->name?> &raquo;<br />
        <span>Код детали:</span>&laquo; <?=$obj->code?> &raquo;</span>
        <input type="hidden" id="obj-id" value="<?=$obj->id?>"/>
    </div>
    
    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- object list -->
    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="checkbox" name="product" id="checked-all"/></th>
            <th width="215">Участок</th>
            <th width="215">Оборудование</th>
            <th width="215">Узел</th>
            <th width="50">Колич.</th>
        </tr>
            <? $number = 1; ?>
            <? foreach ($objects as $item): ?>
                <tr>
                    <td class="text-center"><?=$number?></td>
                    <td class="text-center">
                        <?=$item->department ? $item->departent : '<span style="color:red;">Не указан</span>'?>
                    </td>
                    <td class="text-center">
                        <? if ($item->equipment): ?>
                            <a href="<?=Url::to(['/object', 'obj_id' => $item->equipment->id])?>"><?=$item->equipment->name?></a>
                        <? else: ?>
                            <span style="color:red">Не указано</span>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if ($item->parent_id != 0): ?>
                            <a href="<?=Url::to(['/object', 'obj_id' => $item->parent_id])?>"><?=$item->parent->name?>
                        <? endif; ?>
                    </td>
                    <td class="text-center">
                        <?=$item->qty ? $item->qty : '<span style="color:red;">Нет</span>'?>
                    </td>
                <? $number++ ?>
                </tr>
            <? endforeach; ?>
    </table>
    
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?//=OrderContentMenuWidget::widget(['order_id' => $order->id])?>
</div>