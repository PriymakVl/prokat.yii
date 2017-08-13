<?php

use \yii\helpers\Url;

?>

<!-- object code -->
<tr>
    <td class="text-center">Код детали(узла)</td>
    <td>
        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $object->id])?>"><?=$object->code?></a> 
    </td>
</tr>

<!--  object name -->
<? if ($object->rus): ?>  
    <tr>
        <td class="text-center">Наимен. детали(узла)</td>
        <td>
            <a href="<?=Url::to(['/object', 'obj_id' => $object->id])?>"><?=$object->rus?></a>
        </td>
    </tr>
<? endif; ?>
<? if ($object->eng): ?>  
    <tr>
        <td class="text-center">Name of detail(unit)</td>
        <td>
            <a href="<?=Url::to(['/object', 'obj_id' => $object->id])?>"><?=$object->eng?></a>
        </td>
    </tr>
<? endif; ?>

<!-- item -->
<? if ($object->item): ?>
    <tr>
        <td class="text-center">Позиция</td>
        <td>
            <?=$object->item?>
        </td>
    </tr>
<? endif; ?>

<!-- file of drawing -->
<? if ($item->file): ?>
    <tr>
        <td class="text-center">Файл чертежа</td>
        <td>
            <? if ($item->pathDrawing): ?>
                <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->file?></a>
            <? elseif ($item->file): ?>
                <?=$item->file?>
            <? endif; ?>    
        </td>
    </tr>
<? endif; ?>
    
<!-- parent -->
<tr>
    <td class="text-center">Место установки</td>
    <td>
        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $object->id])?>"><?=$object->parent->name?></a>
        <? if ($object->similar > 1): ?>
            <br /><a href="<?=Url::to(['/search', 'code' => $object->code])?>">Показать все места</a>     
        <? endif; ?>
    </td>
</tr> 
