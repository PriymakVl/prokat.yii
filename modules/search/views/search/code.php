<?php
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box">
        Поиск произведен по коду:<span>&laquo; <?=$code?> &raquo;</span>
    </div>
<? if ($objects): ?>
    <table>
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="130">Оборудование</th>
            <th width="320">Входит в состав</th>
            <th width="325">Наименование</th>
            <th width="130">Код</th>
        </tr>
        <? foreach ($objects as $obj): ?>
            <tr>
                <td>
                    <input type="radio" name="element" obj_id="<?=$obj->id?>" />
                </td>
                <td class="text-center">
                    <?=$obj->equipment?>
                </td>
                <td>
                    <? if($obj->parent): ?>
                        <a href="/specification?obj_id=<?=$obj->parent->id?>"><?=$obj->parent->name?>
                    <? else: ?>
                        Отсутствует
                    <? endif; ?>
                </td>
                <td>
                        <a href="/object?obj_id=<?=$obj->id?>" title="<?=$obj->eng?>"><?=$obj->name?></a>
                </td>
                <td class="text-center">
                    <a href="<?=Yii::$app->urlManager->createUrl(['object/drawing', 'obj_id' => $obj->id])?>"><?=$obj->code ? $obj->code : 'не указан'?></a>
                </td>
            </tr>
        <? endforeach; ?>
    </table>
<? else: ?>
    <p class="not-result">Поиск не дал результатов</p>
<? endif; ?>
</div>