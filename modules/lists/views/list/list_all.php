<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\lists\widgets\ListMenuWidget;
use app\modules\lists\widgets\ListSortMenuWidget;

$this->registerCssFile('/css/list.css');
    
?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">Перечень всех списков</div>
    <!-- list all -->
    <table id="list-all">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="190">Наименование</th>
            <th width="500">Описание</th>
        </tr>
        <? if ($all): ?>
            <? foreach ($all as $list): ?>
                <tr>
                    <td>
                        <input type="radio" name="list" list_id="<?=$list->id?>" />
                    </td>
                    <td>
                       <?=$list->name?>
                    </td>
                    <td>
                       <?=$list->description?>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="3" class="not-content">Списков нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=ListSortMenuWidget::widget(['params' => $params])?>
    <?=ListMenuWidget::widget()?>
</div>




