<?php  

    use \yii\web\JqueryAsset;
    use app\widgets\MainMenuWidget; 
    use app\modules\lists\widgets\ListMenuWidget;
    use app\modules\lists\widgets\ListItemMenuWidget;

    $this->registerCssFile('/css/list.css');
    //$this->registerJsFile('js/list/list_description.js',  ['depends' => [JqueryAsset::className()]]);
    $this->registerJsFile('js/list/list_description.js');
    $this->registerJsFile('js/list/list_delete.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div class="content">

    <!-- info -->
    <div class="info-box info-list">
        <span>Название списка:</span>&laquo; <?=$list->name?> &raquo;
        <a href="#" onclick="return false" id="list-description-show">подробнее</a>
    </div>

    <!-- list id -->
    <input type="hidden" id="list-id" value="<?=$list->id?>" />

    <!-- list discription -->
    <div id="list-description" style="display:none;">
        <h3>Тип и описание списка:</h3>
        <a href="#" onclick="return false" id="list-description-hide">скрыть</a>
        <div>
            <span>тип списка:</span> &laquo; <?= $list->type ? $list->type : 'Не выбран'?> &raquo;<br/>
            <hr />
            <?=$list->description?>
        </div>
    </div>

    <!-- list content -->
    <table class="list-content">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="320">Наименование</th>
            <th width="250">Описание</th>
            <th width="120">Код</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $element): ?>
                <tr>
                   <td>
                        <input type="radio" name="element" value="<?=$element->id?>" />
                    </td>
                    <td>
                        <? if ($element->child): ?>
                            <a href="<?=Yii::$app->urlManager->createUrl(['object/specification', 'obj_id' => $element->obj_id])?>"><?=$element->name?></a>
                        <? else: ?>
                            <a href="<?=Yii::$app->urlManager->createUrl(['object', 'obj_id' => $element->obj_id])?>"><?=$element->name?></a>
                        <? endif; ?>
                    </td>
                    <td><?=$element->note?></td>
                    <td class="text-center">
                        <a href="<?=Yii::$app->urlManager->createUrl(['object/drawing', 'obj_id' => $element->obj_id])?>"><?= $element->code ? $element->code : 'Не указан'?></a>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">В списке нет элементов</td>
            </tr>
        <? endif; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">

    <?=MainMenuWidget::widget()?>

    <?=ListMenuWidget::widget(['list_id' => $list->id])?>

    <?=ListItemMenuWidget::widget()?>

</div>
