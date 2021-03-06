<?

    use yii\helpers\Url;
    use yii\helpers\Html;

?>

<? if ($children): ?>
    <tbody class="obj-children" <? if ($type == 'standard') echo 'style="display:none;"' ?> <?=$id_box?>>
        <? foreach ($children as $obj): ?>
            <tr <? if ($obj->color == 1) echo 'style="background: #FFFF00;"'; ?>>
                <td>    
                    <input type="checkbox"  name="object" obj_id="<?=$obj->id?>" />
                </td>
                <td class="text-center">
					<? if (!$obj->child): ?>
						<?=$obj->item?>
					<? else:?>
						<a href="<?=Url::to(['/object/specification', 'obj_id' => $obj->id])?>"><?=$obj->item?></a>
					<? endif; ?>
				</td>
                <td>
                    <a style="color:<?=$obj->orders ? 'green' : $color?>;" href="<?=Url::to(['/object', 'obj_id' => $obj->id])?>" title="<?=Html::encode($obj->eng)?>">
                        <?=$obj->name.' '.$obj->dimensions?>
                    </a>    
                </td>
                <td class="text-center">
                    <? if($obj->dwg): ?>
                        <a href="<?=Url::to([$obj->pathDwg])?>" target="_blank"><?=$obj->code ? $obj->code : 'не указан'?></a>     
                    <? elseif ($obj->numberDwg): ?>
                        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $obj->id])?>"><?=$obj->code ? $obj->code : 'не указан'?></a>
                    <? else: ?>
                        <?=$obj->code ? $obj->code : 'не указан'?>
                    <? endif; ?>                    
                </td>
            </tr>
        <? endforeach; ?>
    </tbody>
<? endif; ?>