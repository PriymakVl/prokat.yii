<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingDepartmentTopMenuWidget;

$this->registerCssFile('/css/drawing.css');

?>
<div class="content">
    <!-- info -->
    <div class="info-box margin-bottom-15" style="text-align: center; font-size: 16px; color:#000;">
        Эскиз детали
    </div>
    <!-- top menu -->
    <?=DrawingDepartmentTopMenuWidget::widget()?>
    
    <!-- department dwg data -->
    <table id="dwg-department-data">
        <tr>
            <th width="200">Наименование</th>
            <th width="525">Значение</th>
        </tr>
        
        <!-- number dwg -->
        <tr>
            <td class="text-center">
                Номер эскиза
            </td>
            <td>
                <?=$dwg->fullNumber?>
            </td>
        </tr>
        
        <!-- name dwg -->
        <? if ($dwg->name): ?>
            <tr>
                <td class="text-center">
                    Название эскиза
                </td>
                <td>
                    <?=$dwg->name?>
                </td>
            </tr>
        <? endif; ?>
        
        <!-- file -->
        <tr>
            <td class="text-center">
                Файл чертежа
            </td>
            <td>
                <? if ($dwg->file): ?>
                   <a href="<?=Url::to('/files/department/'.$dwg->file)?>" target="_blank"><?=$dwg->file?></a>
                <? else: ?>
                    <span>Нет</span>
                <? endif; ?>    
            </td>
        </tr>
        
        <!-- file kompas-->
        <tr>
            <td class="text-center">
                Файл в формате компас
            </td>
            <td>
                <? if ($dwg->file_cdw): ?>
                   <a href="<?=Url::to('/files/department/kompas/'.$dwg->file_cdw)?>" target="_blank"><?=$dwg->file_cdw?></a>
                <? else: ?>
                    <span>Нет</span>
                <? endif; ?>    
            </td>
        </tr>
        
        <!-- name object -->
        <tr>
            <td class="text-center">
                Название объекта
            </td>
            <td>
                <? if ($dwg->obj): ?>
                    <?= Html::a($dwg->obj->name, ['/object', 'obj_id' => $dwg->obj->id], ['targer' => '_blank']) ?>
                <? else: ?>
                    <span>Не указан</span>
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