<?php
	use yii\helpers\Url;
	
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box">
        Поиск произведен по номеру:<span>&laquo; <?=$number?> &raquo;</span>
    </div>
<? if ($orders): ?>
    <table>
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="130">Номер заказа</th>
            <th width="395">Наименование</th>
            <th width="130">Период</th>
            <th width="130">Заказал</th>
            <th width="130">Состояние</th>
        </tr>
        <? foreach ($orders as $order): ?>
            <tr>
                <td>
                    <input type="radio" name="element" order_id="<?=$order->id?>" />
                </td>
                <td class="text-center">
                    <a href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>"><?=$order->number?></a>
                </td>
                <td>
                    <a href="<?=Url::to(['/order', 'order_id' => $order->id])?>"><?=$order->name?></a>
                </td>
                <td>
                    <?=$order->year?>
                </td>
                <td class="text-center">
                    <?=$order->customer?>
                </td>
                <td class="text-center">
                    <?=$order->status?>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
<? else: ?>
    <p class="not-result">Поиск не дал результатов</p>
<? endif; ?>
</div>