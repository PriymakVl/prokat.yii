<?php
use yii\helpers\Url;

$this->registerCssFile('css/drawing.css');
?>
<!-- drawing department -->
<table style="margin-top:10px">  
    <caption style="padding:0; font-size:16px; color:#000; text-align:center;" >Чертежи ПКО</caption>      
    <tr>
        <th width="30"><input type="radio" disabled="disabled" /></th>
        <th width="125">№ чертежа</th>
        <th width="70">Листы</th>
        <th>Наименование</th>
        <th width="150">Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
        <tr>
            <td>
                <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
            </td>
            <td class="text-center">
                <?=$dwg->number?>  
            </td>
            <td class="text-center"> 
                <? if ($dwg->sheet_1): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/'.$dwg->category.'/'.$dwg->sheet_1])?>">лист 1</a><br/>                 
                <? endif; ?> 
                <? if ($dwg->sheet_2): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/'.$dwg->category.'/'.$dwg->sheet_2])?>">лист 2</a><br/>                 
                <? endif; ?> 
                <? if ($dwg->sheet_3): ?>           
                    <a target="_blank" href="<?=Url::to(['/files/'.$dwg->category.'/'.$dwg->sheet_3])?>">лист 3</a>                 
                <? endif; ?> 
            </td>
            <td class="text-center"> 
                <a href="<?=Url::to(['/drawing/'.$dwg->category, 'dwg_id' => $dwg->id])?>" target="_blank">
                    <?=$dwg->name?>
                </a> 
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
