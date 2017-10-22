<?php
    
    $this->registerCssFile('css/search.css');
?>
<div class="content">
    <h2 class="title-search">Результаты поиска</h2>
    <div class="info-box">
        Поиск произведен по номеру:<span>&laquo; <?=$number?> &raquo;</span>
        <a href="#" onclick="javascript:history.back();">Вернуться назад</a>
    </div>
    
    <!-- list dwg -->
    <table id="department-dwg-all" class="margin-top-15">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="90">№ эскиза</th>
            <th width="250">Наименование</th>
            <th width="150">Объект</th>
            <th width="200">Узел</th>
        </tr>
            <? foreach ($drawings as $dwg): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->fullNumber, ['/files/department/'.$dwg->file], ['target' => '_blank']) ?>
                        <? else: ?>
                            <?=$dwg->fullNumber?>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if ($dwg->obj): ?>
                            <?= Html::a($dwg->obj->name, ['/drawing/department', 'dwg_id' => $dwg->id]) ?>
                        <? elseif ($dwg->name): ?>
                            <?= Html::a($dwg->name, ['/drawing/department', 'dwg_id' => $dwg->id]) ?> 
                        <? else: ?>
                            <?= Html::a('Не указано', ['/drawing/department', 'dwg_id' => $dwg->id]) ?>
                        <? endif; ?>   
                    </td>
                    <td class="text-center">
                        <? if ($dwg->obj): ?>
                            <?= Html::a($dwg->obj->code, ['/object', 'obj_id' => $dwg->obj->id], ['targer' => '_blank']) ?>
                        <? else: ?>
                            <span>Не указан</span>
                        <? endif; ?>
                    </td>
                    <td class="text-center">
                       <? if ($dwg->obj && $dwg->obj->parent): ?>
                            <?= Html::a($dwg->obj->parent->name, ['/object/', 'obj_id' => $dwg->obj->parent->id], ['targer' => '_blank']) ?>
                        <? endif; ?>
                    </td>
                </tr>
            <? endforeach; ?>
</div>