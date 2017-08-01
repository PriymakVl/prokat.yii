<?php

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppMenuWidget;
use app\modules\applications\widgets\AppTopMenuWidget;
use app\modules\applications\widgets\AppContentMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- top nenu -->
    <?=AppTopMenuWidget::widget(['app_id' => $app->id])?>
    
    <!-- info state of  application -->
    <? if ($state == 'active'): ?>
        <div class="active-order">Активная заявка</div>
    <? endif; ?>
    
    <!-- info -->
    <div class="info-box">
        <span>Заявка:</span>&laquo; <?=$app->title.' '.$app->full_num_out?> &raquo;<br />
        <input type="hidden" id="order-id" value="<?=$app->id?>"/>
    </div>
    
    <!-- application content -->
    <table>
        <tr>
            <th width="30"><input type="checkbox" name="content" id="checked-all"/></th>
            <th width="425">Наименование</th>
            <th width="80">Кол-во</th>
            <th width="85">Цена</th>
            <th width="100">Сумма</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $item): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="content" item_id="<?=$item->id?>" />
                    </td>
                    <td>
                        <a href="<?=Url::to(['/application/content/item', 'item_id' => $item->id])?>"><?=$item->product->name?></a>
                    </td>
                    <td class="text-center">
                        <?=$item->need.' '.$item->product->units?>
                    </td >
                    <td class="text-center">
                       <?= (int)$item->price ? $item->price.' '.$item->currency : ''?> 
                    </td>
                    <td class="text-center">
                       <?=$item->sum?> 
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Содержимого заявки еще нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=AppContentMenuWidget::widget(['app_id' => $app->id])?>
    <?//=AppMenuWidget::widget(['app_id' => $app->id])?>
</div>