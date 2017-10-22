<?
    use yii\helpers\Url;
?>

<table>
    <caption class="search-table-caption">Объект №<?=$number?></caption>
    <tr>
        <th width="130">Код</th>
        <th width="805">Расположение</th>
    </tr>
    <tr>
        <td class="text-center">
            <a href="<?=Url::to(['/object/drawing', 'obj_id' => $object->id])?>"><?=$object->code ? $object->code : 'не указан'?></a>
        </td>
        <td>
            <?=$breadcrumbs?>
        </td>
    </tr>
</table>