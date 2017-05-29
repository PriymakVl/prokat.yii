<?php
	use yii\helpers\Url;
	
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box">
        <? if ($out): ?>
            Поиск произведен по исходящему номеру заявки:<span>&laquo; <?=$out?> &raquo;</span>
        <? else: ?>
            Поиск произведен по номеру ЕНС:<span>&laquo; <?=$ens?> &raquo;</span>
        <? endif; ?>
    </div>
<? if ($orders): ?>
    <table>
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="130">Исх. №</th>
            <th width="130">ЕНС</th>
            <th width="130">Отдел</th>
            <th width="130">Год</th>
            <th width="565">Наименование</th>
            
        </tr>
        <? foreach ($apps as $app): ?>
            <tr>
                <td>
                    <input type="radio" name="element" app_id="<?=$app->id?>" />
                </td>
                <td class="text-center">
                    <?=$app->out?>
                </td>
                <td class="text-center">
                    <?=$app->ens?>
                </td>
                <td>
                    <a href="<?=Url::to(['/application', 'app_id' => $app->id])?>"><?=$order->department?></a>
                </td>
                <td class="text-center">
                    <?=$app->year?>
                </td>
                <td class="text-center">
                    <a href="<?=Url::to(['/application/content/list', 'app_id' => $app->id])?>"><?=$app->title?></a>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
<? else: ?>
    <p class="not-result">Поиск не дал результатов</p>
<? endif; ?>
</div>