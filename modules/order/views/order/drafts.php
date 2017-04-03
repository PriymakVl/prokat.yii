<?php

use \yii\web\JqueryAsset;
use yii\helpers\Html;
use Yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderListMenuWidget;
use app\modules\order\widgets\OrderActiveMenuWidget;

$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Черновики заказов</div>
    
    <!-- top nenu -->
    <?//=OrderTopMenuWidget::widget(['order_id' => $order->id])?>
    
    <!-- drafts -->
    <table id="standart-list">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="690">Наименование заказа</th>
        </tr>
        <? if ($drafts): ?>
            <? foreach ($drafts as $draft): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="draft" draft_id="<?=$draft->id?>" />
                    </td>
                    <td>
                        <a href="<?=Url::to(['/order/draft', 'order_id' =>$draft->id])?>"><?=$draft->name?></a>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Черновиков нет</td>
            </tr>
        <? endif; ?>
    </table>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=OrderListMenuWidget::widget()?>
    <?=OrderActiveMenuWidget::widget()?>
</div>