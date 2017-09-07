<?php
use yii\helpers\Url;

$this->registerCssFile('/css/drawing.css');

?>
<!-- drawing Danieli -->
<table style="margin-top:10px">  
    <caption style="padding:0; font-size:16px; color:#000; text-align:center;" >Чертежи Sundbirsta</caption>      
    <tr>
        <th width="30"><input type="radio" /></th>
        <th width="220">Файл</th>
        <th>Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
    <tr>
        <td>
            <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
        </td>
        <td class="text-center">
            <a target="_blank" href="<?=Url::to(['/files/vendor/'.$dwg->category.'/'.$dwg->file])?>"><?=$dwg->file?></a>
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
