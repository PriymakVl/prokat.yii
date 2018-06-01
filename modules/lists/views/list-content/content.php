<?php

    use yii\helpers\Url;
    use app\widgets\MainMenuWidget; 
    use app\modules\lists\widgets\ListMenuWidget;
    use app\modules\lists\widgets\ListItemMenuWidget;
    use app\widgets\FlashMessageWidget;
    use app\widgets\ShowNoteWidget;

    $this->registerCssFile('/css/list.css');
?>

<div class="content">

    <!-- info -->
    <div class="info-box info-list">
        <span>Название списка:</span>&laquo; <?=$list->name?> &raquo;
        <a href="#" onclick="alert('<?=$list->description?>'); return false" id="list-description-show">подробнее</a>
    </div>

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

    <!-- info list is active -->
    <? if ($list->active): ?>
        <div class="alert alert-success margin-top-15 message-wrp">
            <span>Активный список</span>
            <span class="glyphicon glyphicon-remove" title="Закрыть"></span>
        </div>
    <? endif; ?>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>

    <!-- list content -->
    <table class="list-content margin-top-15">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="320">Наименование элемента</th>
            <th width="250">Описание элемента</th>
            <th width="120">Код</th>
        </tr>
        <? if ($content): ?>
            <? foreach ($content as $item): ?>
                <tr>
                   <td>
                        <input type="radio" name="element" value="<?=$item->id?>" />
                    </td>
                    <td><?=$item->name?></td>
                    <td>
                        <?=ShowNoteWidget::widget(['note' => $item->note, 'lengthMax' => 29])?>
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/search/object/code', 'code' => $item->code])?>"><?=$item->code?></a>
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
