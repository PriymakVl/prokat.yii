<?
use \yii\helpers\Url;
use \yii\web\JqueryAsset;
?>
<? foreach ($parent->children as $item): ?>
    <tr>
        <td>
            <input type="checkbox" name="content" item_id="<?=$item->id?>" />
        </td>
        <!-- drawing -->
        <td class="text-center">
            <? if ($item->pathDrawing): ?>
                <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->drawing?></a>
            <? elseif ($item->drawing): ?>
                <?=$item->drawing?>
            <? else: ?>
                <span style="color:red;">Не указан</span>
            <? endif; ?>
        </td>
        
        <!-- item -->
        <td class="text-center" style="background:yellow;">
            <? if ($parent->item): ?>
                <?=$parent->item?> / <?=$item->item?>
            <? else: ?>
                <?=$item->item?>
            <? endif; ?>
        </td>
        
        <!-- name -->
        <td>
            <a href="<?=Url::to(['/order/content/item', 'item_id' => $item->id])?>"><?=$item->name?></a>
        </td>
        
        <!-- count -->
        <td class="text-center">
            <?=$item->count ? $item->count : '<span style="color:red;">Нет</span>'?>
        </td>
        
        <!-- material -->
        <td class="text-center">
            <?=$item->material ? $item->material : '<span style="color:red;">Нет</span>'?>
        </td>
    </tr>
<? endforeach; ?>