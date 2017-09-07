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
    <div class="title-box">Перечень эскизов</div>
    
    <!-- top menu -->
     <?=DrawingListTopMenuWidget::widget(['params' => $params])?>
     
    <!-- list dwg -->
    <table id="department-dwg-all">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="90">№ эскиза</th>
            <th width="250">Наименование</th>
            <th width="150">Объект</th>
            <th width="200">Узел</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->fullNumber, ['/files/department/'.$dwg->file], ['target' => '_blank']) ?>
                        <? else: ?>
                            <?=$dwg->fullNumber?>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if ($dwg->obj): ?>
                            <?= Html::a($dwg->obj->name, ['/drawing/department', 'dwg_id' => $dwg->id]) ?>
                        <? elseif ($dwg->name): ?>
                            <?= Html::a($dwg->name, ['/drawing/department', 'dwg_id' => $dwg->id]) ?> 
                        <? else: ?>
                            <?= Html::a('Не указано', ['/drawing/department', 'dwg_id' => $dwg->id]) ?>
                        <? endif; ?>   
                    </td>
                    <td class="text-center">
                        <? if ($dwg->obj): ?>
                            <?= Html::a($dwg->obj->code, ['/object', 'obj_id' => $dwg->obj->id], ['targer' => '_blank']) ?>
                        <? else: ?>
                            <span>Не указан</span>
                        <? endif; ?>
                    </td>
                    <td class="text-center">
                       <? if ($dwg->obj && $dwg->obj->parent): ?>
                            <?= Html::a($dwg->obj->parent->name, ['/object/', 'obj_id' => $dwg->obj->parent->id], ['targer' => '_blank']) ?>
                        <? endif; ?>
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
    <?//=DrawingListMenuWidget::widget()?>
    <?//=DrawingMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>