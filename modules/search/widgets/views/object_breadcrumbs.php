<?
    use yii\helpers\Url;
?>

<tr>
    <td align="center"><?=$number?></td>
    <td align="center">
        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $object->id])?>"><?=$object->code?></a>
    </td>
    <td><?=$breadcrumbs?></td>
</tr>
