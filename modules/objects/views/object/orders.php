<?php  

use yii\web\JqueryAsset;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectSearchMenuWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;

$this->registerCssFile('css/specification.css');
    
?>
<div class="content">
    <!-- top nenu -->
    <?=ObjectTopMenuWidget::widget(['obj_id' => $obj->id])?>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название:</span>&laquo; <?=$obj->name?> &raquo;
        <? if ($obj->code): ?>
            <br />
            <span>Код:</span>&laquo; <?=$obj->code?> &raquo;
        <? endif; ?>
    </div>
    
    <!-- specification -->
    <table class="margin-top-15">
        <tr>
            <th width="80">Номер</th>
            <th width="550">Наименование</th>
            <th width="90">Состояние</th>
        </tr>
        <? foreach ($obj->orders as $order): ?>
        <tr>
            <td class="text-center">
                <a href="<?=Url::to(['/order', 'order_id' => $order->id])?>"><?=$order->number?></a>
            </td>
            <td>
                <a href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>"><?=$order->name?></a>
            </td>
            <td class="text-center"><?=$order->state?></td>
        </tr>
        <? endforeach; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ObjectSearchMenuWidget::widget()?>
</div> 