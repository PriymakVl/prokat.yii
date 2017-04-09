<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingListMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingListTopMenuWidget;

$this->registerCssFile('/css/drawing.css');

?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">Перечень цеховых чертежей(эскизов)</div>
    
    <!-- top menu -->
     <?=DrawingListTopMenuWidget::widget(['params' => $params])?>
     
    <!-- list dwg -->
    <table id="department-dwg-all">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="100">№ чертежа</th>
            <th width="460">Наименование</th>
            <th width="130">Оборудование</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->number, ['/files/department/'.$dwg->file], ['target' => '_blank']) ?>
                        <? elseif($dwg->type == 'folder'): ?>
                            <?= Html::a('папка', ['/drawing/department/folder/', 'dwg_id' => $dwg->id]) ?>
                        <? else: ?>
                            <?=$dwg->number?>
                        <? endif; ?>
                    </td>
                    <td>
                        <?= Html::a($dwg->name, ['/drawing/department/', 'dwg_id' => $dwg->id]) ?>
                    </td>
                    <td class="text-center">
                       <?=$dwg->equipment ? $dwg->equipment : "Не указано"?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Чертежей нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- contorller for js srcipt update-parent -->
    <input type="hidden" id="dwg-controller" value="<?=Yii::$app->controller->id?>"/>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingListMenuWidget::widget()?>
    <?=DrawingMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>