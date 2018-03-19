<?php

use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
use app\modules\inventory\models\Inventory;
use app\modules\inventory\widgets\InventoryListMenuWidget;
use app\modules\inventory\widgets\InventoryTopListMenuWidget;

$this->registerCssFile('/css/inventory.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Инвентарные номера сортопрокатного стана</div>
    
    <!-- top nenu -->
    <?=InventoryTopListMenuWidget::widget(['params' => $params])?>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>
    
    <!-- inventory numbers -->
    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="100">Инв. номер</th>
            <th width="355">Наименование</th>
            <th width="140">Категория</th>
            <th width="100">Примечание</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $inventory): ?>
                <tr>
                    <td>
                        <input type="radio" name="inventory" inv_id="<?=$inventory->id?>" />
                    </td>
                    <td class="text-center">
                        <? if ($inventory->obj_id): ?>
                            <a href="<?=Url::to(['/objec', 'obj_id' => $inventory->obj_id])?>"><?=$inventory->number?></a>
                        <? else: ?>
                            <?=$inventory->number?>
                        <? endif; ?> 
                    </td>
                    <td>
                       <a href="<?=Url::to(['/inventory', 'inv_id' => $inventory->id])?>"><?=$inventory->name?></a> 
                    </td>
                    <td class="text-center">
                       <?=$inventory->category?> 
                    </td>
                    <td class="text-center">
                       <?=$inventory->note?> 
                    </td>
                </tr>
            <? endforeach; ?>  
        <? else: ?>
            <tr>
                <td colspan="5" class="not-content">Инвентарных номеров нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=InventoryListMenuWidget::widget()?>
</div>