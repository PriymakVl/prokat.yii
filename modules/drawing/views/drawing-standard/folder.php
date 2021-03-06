<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;
use app\components\drawingmenu\DrawingMainMenuWidget;
use app\components\drawingmenu\DrawinglistTopMenuWidget;
    
$this->registerCssFile('/css/drawing.css');

?>
<div class="content list-all">
    <!-- title -->
    <div class="title-box dwg-folder"><span>папка:</span><?=$folder->name?></div>
    <!-- folder dwg -->
    <table id="department-dwg-folder">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="100">№ чертежа</th>
            <th width="460">Наименование</th>
            <th width="130">Оборудование</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $dwg): ?>
                <tr>
                    <td>
                        <input type="radio" name="drawing" dwg_id="<?=$dwg->id?>" />
                    </td>
                    <td class="text-center">
                        <? if($dwg->file): ?>
                            <?= Html::a($dwg->number, ['/files/department/'.$dwg->file]) ?>
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
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>