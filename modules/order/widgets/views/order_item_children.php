<?
use \yii\helpers\Url;
use \yii\web\JqueryAsset;
?>
<? foreach ($children as $item): ?>
    <tr class="item-children">
        <td>
            <input type="checkbox" name="content" item_id="<?=$item->id?>" />
        </td>
        <!-- drawing -->
        <td class="text-center item-children">
            <? if ($item->pathDrawing): ?>
                <a target="_blank" href="<?=Url::to([$item->pathDrawing])?>"><?=$item->drawing?></a>
            <? elseif ($item->drawing): ?>
                <?=$item->drawing?>
            <? else: ?>
                <span style="color:red;">Не указан</span>
            <? endif; ?>
        </td>
        
        <!-- item -->
        <td class="text-center">
            <?=$item->item?>
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