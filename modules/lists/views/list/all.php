<?php

use yii\helpers\Url;
use yii\web\View;
use app\widgets\FlashMessageWidget;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\lists\widgets\ListMenuWidget;
use app\modules\lists\widgets\ListSortMenuWidget;
use app\widgets\FiltersGroupWidget;

$this->registerCssFile('/css/list.css');
?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">
        <!-- <a href="<?//=Url::to('/lists/show/filters')?>" id="show-filters">Фильтры</a> -->
        <span>Перечень всех списков</span>
    </div>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>

    <!-- filter lists -->
    <?=View::render('filter_lists', compact('groups', 'params'))?>

    <!-- list all -->
    <table id="list-all" class="margin-top-15">
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
                        <a href="<?=Url::to(['/list/content', 'list_id' => $list->id])?>"><?=$list->name?></a>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/list', 'list_id' => $list->id])?>"><?=$list->description?></a>
                    </td>
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
    <?=ListMenuWidget::widget()?>
</div>




