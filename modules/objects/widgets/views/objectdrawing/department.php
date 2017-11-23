<?php
use yii\helpers\Url;

$this->registerCssFile('css/drawing.css');
?>
<!-- drawing department -->
<table style="margin-top:10px">  
    <caption style="padding:0; font-size:16px; color:#000; text-align:center;" >Цеховые эскизы</caption>      
    <tr>
        <th width="30"><input type="radio" disabled="disabled" /></th>
        <th width="115">Конструктор</th>
        <th width="85">№ эскиза</th>
        <th width="140">Файл эскиза</th>
        <th width="140">Файл компас</th>
        <th>Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
        <tr>
            <td>
                <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
            </td>
            <td class="text-center">
                <?=$dwg->designer ? $dwg->designer : 'Не указан'?>
            </td>
            <td class="text-center">
                <a href="<?=Url::to(['/drawing/'.$dwg->category, 'dwg_id' => $dwg->id])?>" target="_blank"><?=$dwg->fullNumber?></a>
            </td>
            <td class="text-center"> 
                <? if ($dwg->file): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/department/'.$dwg->file])?>"><?=$dwg->file?></a>                 
                <? else: ?>
                    <span style="color:red;">Не добавлен</span>
                <? endif; ?>
            </td>
            <td class="text-center"> 
                <? if ($dwg->file_cdw): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/department/kompas/'.$dwg->file_cdw])?>"><?=$dwg->file_cdw?></a>                 
                <? else: ?>
                    <span style="color:red;">Не добавлен</span>
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
