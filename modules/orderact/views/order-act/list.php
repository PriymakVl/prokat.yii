<?php

use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
//use app\modules\order\models\Order;
//use app\modules\order\widgets\OrderMenuWidget;
//use app\modules\orderlist\widgets\OrderListActiveMenuWidget;
use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\orderact\widgets\OrderActTopListMenuWidget;
//use app\modules\orderlist\widgets\ListMenuWidget;

//$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень актов выполнения заказов</div>
    
    <!-- top nenu -->
    <?=OrderActTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- list akt orders -->
    <table>
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="200">Месяц</th>
            <th width="90">Номер</th>
            <th width="200">Заказ</th>
            <th width="200">Состояние</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $act): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order-act" act_id="<?=$act->id?>" />
                    </td>
                    <td>
                        <? $color = $act->active ? 'green' : 'grey'; ?>
                        <span style="color: <?=$color?>"><?=$act->mounth?></span>
                    </td>
                    <td class="text-center">
                        <a  href="<?=Url::to(['/order-act/content', 'act_id' =>$act->id])?>"><?=$act->number?></a>
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/order', 'order_id' => $act->order->id])?>"><?=$act->order->number?></a>
                    </td>
                    <td>
                        <?=$act->state?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="5" class="not-content">Актов еще нет</td>
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
    <?=OrderActListMenuWidget::widget()?>
    <?//=OrderActiveMenuWidget::widget()?>
    <?//=ListMenuWidget::widget()?>
</div>