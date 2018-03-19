<?php
	use yii\helpers\Url;
	use app\modules\order\models\Order;
	
    $this->registerCssFile('/css/search.css');
?>
<div class="content">
    <h2 class="title-search text-center">Результаты поиска</h2>
    <div class="info-box margin-bottom-15">
        <? if ($number): ?>
            Поиск произведен по номеру заказа:<span>&laquo; <?=$number?> &raquo;</span>
        <? elseif ($drawing): ?>
            Поиск произведен по номеру чертежа:<span>&laquo; <?=$drawing?> &raquo;</span>
        <? else:?>
            Поиск произведен по номеру коду детали:<span>&laquo; <?=$code?> &raquo;</span>
        <? endif; ?>
        <a href="#" onclick="javascript:history.back();">Вернуться назад</a>
    </div>
<? if ($orders): ?>
    <table>
            <? if ($number): ?>
            <tr>
                <th width="30"><input type="radio" disabled="disabled" /></th>
                <th width="130">Номер заказа</th>
                <th width="565">Наименование</th>
                <th width="130">Период</th>
                <th width="130">Заказал</th>
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
                        <a href="<?=Url::to(['/order', 'order_id' => $order->id])?>" <? if ($order->state != Order::STATE_ACTIVE) echo 'class="red"'; ?>><?=$order->name?></a>
                    </td>
                    <td class="text-center">
                        <?=$order->period?>
                    </td>
                    <td class="text-center">
                        <?=$order->customer?>
                    </td>
                </tr>
            <? endforeach; ?>
        <!-- result of search by code or drawing -->
        <? elseif ($drawing || $code): ?>
            <tr>
                <th width="30"><input type="radio" disabled="disabled" /></th>
                <th width="130">Номер заказа</th>
                <th width="130">Чертеж</th>
                <th width="130">Код</th>
                <th width="565">Наименование</th>
            </tr>
            <? foreach ($orders as $order): ?>
                <tr>
                    <td>
                        <input type="radio" name="element" order_id="<?=$order->id?>" />
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/order/content/list', 'order_id' => $order->id])?>"><?=$order->number?></a>
                    </td>
                    <?php
                        foreach ($order->content as $item):
                        $data = $item->getSearchItem($code, $drawing);
                        if (!$data) continue;
                    ?>
                    <td align="center"><?=$data['drawing']?></td>
                    <td align="center"><?=$data['code']?></td>
                    <?
                        if ($data) break;
                        endforeach;
                    ?>
                    <td>
                        <a href="<?=Url::to(['/order', 'order_id' => $order->id])?>"><?=$order->name?></a>
                    </td>
                </tr>
            <? endforeach; ?>
        <? endif; ?>
    </table>
<? else: ?>
    <p class="not-result">Поиск не дал результатов</p>
<? endif; ?>
</div>