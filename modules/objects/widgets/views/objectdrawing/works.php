<?php
use yii\helpers\Url;
?>
<? foreach ($drawings as $dwg): ?>
    <? foreach ($dwg->files as $file): ?>
        <tr>
            <td>
                <input type="radio" name="dwg" dwg_id="<?=$dwg->id?>" file_id="<?=$file->id?>" file="<?=$file->file?>" dwg_cat="<?=$dwg->category?>" obj_id="<?=$obj_id?>" />
            </td>
            <td class="text-center">
                <a href="<?=Url::to(['/drawing/works', 'dwg_id' => $dwg->id])?>" target="_blank"><?=$dwg->catName?></a>
            </td>
            <td class="text-center">нет</td>
            <td class="text-center">
                <?=$dwg->sheets ? $dwg->sheets : '1'?>
            </td>
            <td class="text-center">
                <?=$file->sheet ? $file->sheet : '1'?>
            </td>
            <td class="text-center">              
                <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['files/'.$dwg->category.'/'.$file->file])?>"><?=$file->file?></a>
            </td>
            <td>
                <? if($file->cutNote): ?>
                    <span class="note-cut" note="<?=$file->note?>" title="показать полный текст примечания"><?=$file->cutNote?></span>
                <? else: ?>
                    <?=$file->note?> 
                <? endif; ?>   
            </td>
        </tr>
    <? endforeach; ?>
<? endforeach; ?>