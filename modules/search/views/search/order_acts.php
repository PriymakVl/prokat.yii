<?php
	use yii\helpers\Url;
	
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <!-- info search -->
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box">
        <? if ($number): ?>
            Поиск произведен по номеру акта:<strong>&nbsp;&laquo;&nbsp;<?=$number?>&nbsp;&raquo;</strong>
        <? else: ?>
            Поиск произведен по номеру чертежа:<strong>&nbsp;&laquo;&nbsp;<?=$drawing?>&nbsp;&raquo;</strong>
        <? endif; ?>
        <a href="#" onclick="javascript:history.back();">Вернуться назад</a>
    </div>
    
    <!-- result search --> 
    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="80">№ акта</th>
            <th width="80">№ заказа</th>
            <th width="480">Наим-ние заказа</th>
            <th width="130">Период</th>
            <th width="130">Участок РМЦ</th>
        </tr>
        <? foreach ($acts as $act): ?>
            <tr>
                <td>
                    <input type="radio" name="element" act_id="<?=$act->id?>" />
                </td>
                <td class="text-center">
                    <a href="<?=Url::to(['/order/act', 'act_id' => $act->id])?>"><?=$act->number?></a>
                </td>
                <td class="text-center">
                    <a href="<?=Url::to(['/order/content', 'order_id' => $act->order->id])?>"><?=$act->order->number?></a>
                </td>
                <td>
                    <a href="<?=Url::to(['/order', 'order_id' => $act->order->id])?>"><?=$act->order->name?></a>
                </td>
                <td class="text-center">
                    <?=$act->period?>
                </td>
                <td class="text-center">
                    <?=$act->department?>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
</div>