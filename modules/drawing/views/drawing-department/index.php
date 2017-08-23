<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingDepartmentTopMenuWidget;

$this->registerCssFile('/css/drawing.css');

?>
<div class="content">

    <!-- top menu -->
    <?=DrawingDepartmentTopMenuWidget::widget()?>
    
    <!-- department dwg data -->
    <table id="dwg-department-data">
        <tr>
            <th width="200">Наименование</th>
            <th width="525">Значение</th>
        </tr>
        <!-- name -->
        <tr>
            <td class="text-center">
                <? if ($dwg->type == 'folder'): ?>
                    Название папки
                <? else: ?>
                    Назание эскиза
                <? endif; ?>
            </td>
            <td>
                <? if ($dwg->child): ?>
                    <?= Html::a($dwg->name, ['/drawing/department/folder/', 'dwg_id' => $dwg->id]) ?>
                <? else: ?>
                    <?=$dwg->name?>
                <? endif; ?>
            </td>
        </tr>
        
        <!-- alias -->
        <tr>
            <td class="text-center">
                Короткое название
            </td>
            <td>
                <?=$dwg->alias?>
            </td>
        </tr>
        
        <!-- number -->
        <tr>
            <td class="text-center">
                <? if ($dwg->type == 'folder'): ?>
                    Номер папки
                <? else: ?>
                    Номер эскиза
                <? endif; ?>
            </td>
            <td>
                <? if ($dwg->type == 'folder'): ?>
                    <?=$dwg->id?>
                <? else: ?>
                    <?=$dwg->number?>
                <? endif; ?>
            </td>
        </tr>
        
        <!-- note -->
        <? if ($dwg->note): ?>
            <tr>
                <td class="text-center">Примечание</td>
                <td><?=$dwg->note?></td>
            </tr>
        <? endif; ?>
        
        <!-- file dwg -->
        <? if ($dwg->type == 'file'): ?>
            <tr>
                <td class="text-center">Файл эскиза</td>
                <td>
                    <? if($dwg->file): ?>
                        <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['/files/department/'.$dwg->file])?>"><?=$dwg->file?></a>
                    <? else: ?>
                        не указан
                    <? endif; ?>
                </td>
            </tr>
        <? endif; ?>
        
        <!-- file kompas -->
        <? if ($dwg->file_cdw): ?>
            <tr>
                <td class="text-center">Файл эскиза в компасе</td>
                <td>
                    <? if($dwg->file_cdw): ?>
                        <a target="_blank" href="<?=Yii::$app->urlManager->createUrl(['/files/department/'.$dwg->file_cdw])?>"><?=$dwg->file_cdw?></a>
                    <? else: ?>
                        не указан
                    <? endif; ?>
                </td>
            </tr>
        <? endif; ?>
        
        <!-- service -->
        <tr>
            <td class="text-center">Служба</td>
            <td><?=$dwg->service?></td>
        </tr>
        <!-- designer -->
        <tr>
            <td class="text-center">Конструктор</td>
            <td><?= $dwg->designer ? $dwg->designer : 'не указан'?></td>
        </tr>
        <!-- date of create -->
        <tr>
            <td class="text-center">Дата создания</td>
            <td><?=$dwg->date?></td>
        </tr>
    </table>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=DrawingMenuWidget::widget(['dwg_id' => $dwg->id])?>
    
    <?=DrawingMainMenuWidget::widget()?>
</div>