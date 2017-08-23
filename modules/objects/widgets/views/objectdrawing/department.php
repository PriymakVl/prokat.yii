<?php
use yii\helpers\Url;
?>
<!-- drawing department -->
<table>  
    <caption>Цеховые эскизы</caption>      
    <tr>
        <th width="30"><input type="radio" disabled="disabled" /></th>
        <th width="220">Конструктор</th>
        <th width="100">Создан</th>
        <th width="150">Файл</th>
        <th>Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
        <tr>
            <td>
                <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
            </td>
            <td class="text-center">
                <a href="<?=Url::to(['/drawing/'.$dwg->category, 'dwg_id' => $dwg->id])?>" target="_blank">
                    <?=$dwg->designer ? $dwg->designer : 'Не указан'?>
                </a>
            </td>
            <td class="text-center">
                <?=date('d.m.y', $dwg->date)?>
            </td>
            <td class="text-center"> 
                <? if ($dwg->file): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/'.$dwg->category.'/'.$dwg->file])?>"><?=$dwg->file?></a>                 
                <? else: ?>
                    <span style="color:red;">Нет файла</span>
                <? endif; ?>
            </td>
            <td>
                <? if($dwg->cutNote): ?>
                    <span class="note-cut" note="<?=$dwg->note?>" title="показать полный текст примечания"><?=$dwg->cutNote?></span>
                <? else: ?>
                    <?=$dwg->note?> 
                <? endif; ?>   
            </td>
        </tr>
    <? endforeach; ?>
</table>
