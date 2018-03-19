<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;
//use app\modules\order\widgets\OrderMenuWidget;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\widgets\OrderActListMenuWidget;
use app\modules\orderact\widgets\OrderActTopListMenuWidget;

//use app\modules\orderlist\widgets\ListMenuWidget;

//$this->registerCssFile('/css/standard.css');
//$this->registerJsFile('/js/orderact/show_filters_box.js');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <a href="<?=Url::to('/order/act/show/filters')?>" id="show-filters">Фильтры</a>
        <span>Перечень актов за </span>
        <strong><?= $period ?></strong>
    </div>

    <!-- top nenu -->
    <?= OrderActTopListMenuWidget::widget(['params' => $params]) ?>

    <!-- info message -->
    <?= FlashMessageWidget::widget() ?>

    <!-- list akt orders -->
    <table class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" name="order" id="checked-all"/>
            </th>
            <th width="60">№ акта</th>
            <th width="80">№ заказа</th>
            <th width="345">Наименование заказа</th>
            <th width="90">Стоимость</th>
            <th width="120">Заказал</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $act): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="order-act" act_id="<?= $act->id ?>"/>
                    </td>
                    <td class="text-center">
                        <a style="color:<?= $act->colorState ?>"
                           href="<?= Url::to(['/order/act', 'act_id' => $act->id]) ?>"><?= $act->number ?></a>
                    </td>
                    <td class="text-center">
                        <a href="<?= Url::to(['/order/content/list', 'order_id' => $act->order->id]) ?>"><?= $act->order->number ?></a>
                    </td>
                    <td>
                        <a href="<?= Url::to(['/order', 'order_id' => $act->order->id]) ?>"><?= $act->order->name ?></a>
                    </td>
                    <td class="text-center">
                        <?= $act->cost ? $act->cost . 'грн.' : '<span class="red">Нет</span>' ?>
                    </td>
                    <td>
                        <?= $act->order->customer ? $act->order->customer : 'Не указан' ?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="6" class="not-content">Актов еще нет</td>
            </tr>
        <? endif; ?>
    </table>

    <? if ($count): ?>
        <table class="margin-top-15">
            <tr>
                <td width="300">Количество актов</td>
                <td><?= $count ?></td>
            </tr>
            <!-- month cost -->
            <? if ($costs): ?>
                <tr>
                    <td width="300">Общая себестоимость</td>
                    <td><?= $costs['all'] . 'грн' ?></td>
                </tr>
                <? if ($costs['make']): ?>
                    <tr>
                        <td width="300">Cебестоимость изготовления</td>
                        <td><?= $costs['make'] . 'грн' ?></td>
                    </tr>
                <? endif; ?>
                <? if ($costs['current']): ?>
                    <tr>
                        <td width="300">Cебестоимость текущего ремонта</td>
                        <td><?= $costs['current'] . 'грн' ?></td>
                    </tr>
                <? endif; ?>
                <? if ($costs['capital']): ?>
                    <tr>
                        <td width="300">Cебестоимость кап. ремонта</td>
                        <td><?= $costs['capital'] . 'грн' ?></td>
                    </tr>
                <? endif; ?>
                <? if ($costs['enhancement']): ?>
                    <tr>
                        <td width="300">Cебестоимость улучшения</td>
                        <td><?= $costs['enhancement'] . 'грн' ?></td>
                    </tr>
                <? endif; ?>
            <? endif; ?>
        </table>
    <? endif; ?>

</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?= MainMenuWidget::widget() ?>
    <?= OrderActListMenuWidget::widget() ?>
    <? //=OrderActiveMenuWidget::widget()?>
    <? //=ListMenuWidget::widget()?>
</div>