<?php
use yii\helpers\Url;

$this->registerCssFile('css/drawing.css');
?>
<!-- drawing department -->
<table style="margin-top:10px">  
    <caption style="padding:0; font-size:16px; color:#000; text-align:center;" >Стандарт Danieli</caption>      
    <tr>
        <th width="30"><input type="radio" disabled="disabled" /></th>
        <th width="100">Код</th>
        <th width="220">Наименование</th>
        <th>Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
        <tr>
            <td>
                <input type="radio" name="dwg" disabled="disabled" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
            </td>
            <td class="text-center"> 
                <? if ($dwg->file): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/standard/danieli/'.$dwg->file])?>"><?=$dwg->code?></a>                 
                <? endif; ?>
            </td>
            <td>
                <?=$dwg->name?>
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
