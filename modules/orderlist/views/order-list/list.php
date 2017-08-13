<?php

use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
//use app\modules\order\models\Order;
//use app\modules\order\widgets\OrderMenuWidget;
//use app\modules\orderlist\widgets\OrderListActiveMenuWidget;
use app\modules\orderlist\widgets\OrderListListMenuWidget;
use app\modules\orderlist\widgets\OrderListTopListMenuWidget;
//use app\modules\orderlist\widgets\ListMenuWidget;

//$this->registerCssFile('/css/standard.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень списков с заказами сортопрокатного стана</div>
    
    <!-- top nenu -->
    <?=OrderListTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- list list orders -->
    <table>
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all" />
            </th>
            <th width="90">Тип</th>
            <th width="600">Наименование</th>
        </tr>
        <? if ($list_list): ?>
            <? foreach ($list_list as $list): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order-list" list_id="<?=$list->id?>" />
                    </td>
                    <td class="text-center">
                        <? if ($list->content): ?>
                            <? $color = $list->active ? 'green' : 'grey'; ?>
                            <a style="color: <?=$color?>" href="<?=Url::to(['/order-list/content', 'list_id' =>$list->id])?>"><?=$list->type?></a>
                        <? else: ?>
                            <?=$list->type?>
                        <? endif; ?>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/order-list', 'list_id' => $list->id])?>"><?=$list->name?></a>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Списков еще нет</td>
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
    <?=OrderListListMenuWidget::widget()?>
    <?//=OrderActiveMenuWidget::widget()?>
    <?//=ListMenuWidget::widget()?>
</div>