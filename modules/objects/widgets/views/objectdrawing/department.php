<?php
use yii\helpers\Url;
?>
<!-- drawing vendor -->
<? foreach ($drawings as $dwg): ?>
<tr>
    <td>
        <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
    </td>
    <td class="text-center">
        <a href="<?=Url::to(['/drawing/department', 'dwg_id' => $dwg->id])?>" target="_blank"><?=$dwg->catName?></a>
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
        <? if ($dwg->file): ?>           
            <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/'.$dwg->category.'/'.$dwg->file])?>"><?=$dwg->file?></a>                 
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
