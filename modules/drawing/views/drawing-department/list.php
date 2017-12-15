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
    <table id="department-dwg-all" class="margin-top-15">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="90">№ эскиза</th>
            <th width="300">Наименование</th>
            <th width="100">Код</th>
            <th width="200">Примечание</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="radio" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->fullNumber, ['/files/department/'.$dwg->file], ['target' => '_blank']) ?>
                        <? else: ?>
                            <?=$dwg->fullNumber?>
                        <? endif; ?>
                    </td>
                    <td>
                        <? if ($dwg->name): ?>
                            <a href="<?=Url::to(['/drawing/department', 'dwg_id' => $dwg->id])?>"><?=$dwg->name?></a>
                        <? elseif ($dwg->objects): ?>
                            <a href="<?=Url::to(['/drawing/department', 'dwg_id' => $dwg->id])?>"><?=$dwg->objects[0]->name?></a>
                        <? else: ?>
                            <a href="<?=Url::to(['/drawing/department', 'dwg_id' => $dwg->id])?>"><?='Эскиз '.$dwg->fullNumber?></a>
                        <? endif; ?>   
                    </td>
                    <td class="text-center">
                        <? if ($dwg->code): ?>
                            <a href="<?=Url::to(['/search', 'code' => $dwg->code])?>"><?=$dwg->code?></a>
                        <? else: ?>
                            <span>Не указан</span>
                        <? endif; ?>
                    </td>
                    <td>
                        <?=$dwg->note?>
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
    <?//=DrawingMenuWidget::widget()?>
    <?//=DrawingMainMenuWidget::widget()?>
</div>