<?php

use Yii\helpers\Url;
use yii\web\View;
use app\widgets\MainMenuWidget;
use app\widgets\FlashMessageWidget;


$this->registerCssFile('/css/equipment.css');

?>
<div class="content">
    <!-- title -->
    <? if ($breadcrumbs): ?>
        <div class="breadcrumbs-wrp"><?=$breadcrumbs?></div>
    <? else: ?>
        <div class="title-box">Группы оборудования</div>
    <? endif; ?>

    <!-- top nenu -->
    <?//=View::render('/menu_top_list')?>

    <!-- flash messge -->
    <?=FlashMessageWidget::widget()?>

    <table class="margin-top-15">
        <tr>
            <th width="30"><input type="radio" disabled="disabled" /></th>
            <th width="420">Название</th>
            <th width="200">Короткое название</th>
            <th width="70">Рейтинг</th>
        </tr>
        <? if ($items): ?>
            <? foreach ($items as $item): ?>
                <tr>
                    <td>
                        <input type="radio" name="subgroup" item_id="<?=$item->id?>" />
                    </td>
                    <td>
                        <a href="<?=Url::to(['/equipment/group/list', 'parent_id' => $item->id])?>"><?=$item->name?></a>
                    </td>
                    <td><?=$item->alias?></td>
                    <td align="center"><?=$item->rating?></td>
                </tr>
            <? endforeach; ?>  
        <? else: ?>
            <tr>
                <td colspan="3" class="not-content">Групп оборудование еще нет</td>
            </tr>
        <? endif; ?>
    </table>
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=View::render('menu')?>
</div>