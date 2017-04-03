<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;
use app\components\drawingmenu\DrawingMainMenuWidget;
use app\components\drawingmenu\DrawingListMenuWidget;
use app\components\drawingmenu\DrawingListTopMenuWidget;

$this->registerCssFile('/css/drawing.css');
$this->registerJsFile('js/drawing/list_update_parent.js',  ['depends' => [JqueryAsset::className()]]);

?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box">Перечень стандартов</div>
    
    <!-- top menu -->
     <?=DrawingListTopMenuWidget::widget()?>
     
    <!-- list dwg -->
    <table id="department-dwg-all">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="100">Обозначение</th>
            <th width="460">Наименование</th>
            <th width="130">Примечание</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->code, ['/files/standard/'.$dwg->file], ['target' => '_blank']) ?>
                        <? elseif($dwg->type == 'folder'): ?>
                            <?= Html::a('папка', ['/drawing/standard/specification/', 'dwg_id' => $dwg->id]) ?>
                        <? else: ?>
                            <?=$dwg->number ? $dwg->number : "Не указан"?>
                        <? endif; ?>
                    </td>
                    <td>
                        <?= Html::a($dwg->name, ['/drawing/standard/', 'dwg_id' => $dwg->id]) ?>
                    </td>
                    <td class="text-center">
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
    
    <!-- type drawing hidden -->
    <input type="hidden" value="<?=Yii::$app->controller->id?>" id="dwg-controller"/>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingListMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>