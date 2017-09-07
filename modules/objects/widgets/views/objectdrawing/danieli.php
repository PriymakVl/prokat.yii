<?php
use yii\helpers\Url;

$this->registerCssFile('/css/drawing.css');
$this->registerJsFile('/js/drawing/dwg_revision_toggle.js');
?>
<!-- drawing Danieli -->
<table style="margin-top:10px">  
    <caption style="padding:0; font-size:16px; color:#000; text-align:center;" >Чертежи Danieli</caption>      
    <tr>
        <th width="30"><input type="radio" /></th>
        <th width="100">Доработка</th>
        <th width="60">Листов</th>
        <th width="60">Лист</th>
        <th width="150">Файл</th>
        <th>Примечание</th>
    </tr>
    <? foreach ($drawings as $dwg): ?>
    <tr <? if ($new_revision != $dwg->revision) echo 'class="row-hide dwg-revision-hide"'; ?>>
        <td>
            <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
        </td>
        <td class="text-center">
            <?=$dwg->revision?>
        </td>
        <td class="text-center">
            <?=$dwg->sheets ? $dwg->sheets : '1'?>
        </td>
        <td class="text-center">
            <?=$dwg->sheet ? $dwg->sheet : '1'?>
        </td>
        <td class="text-center">
            <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/vendor/'.$dwg->category.'/'.$dwg->file])?>"><?=$dwg->file?></a>
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
    <!-- revision toggle -->
    <? if ($old_revision): ?>
        <tr >
           <td colspan="7"><a href="#" onclick="return false;" id="dwg-revision-toggle">Показать все доработки Danieli</a></td> 
        </tr>
    <? endif; ?>
</table>
