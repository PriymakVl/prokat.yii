<? foreach ($drawings as $dwg): ?>
<tr>
    <td>
        <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file="<?=$dwg->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
    </td>
    <td class="text-center">
        <a href="#" onclick="return false;" id="show-data"><?=$dwg->catName?></a>
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
        <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/'.$dwg->category.'/'.$dwg->equipment.'/'.$dwg->file])?>"><?=$dwg->file?></a>
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
