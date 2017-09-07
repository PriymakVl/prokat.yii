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
    <?//=DrawingDepartmentTopMenuWidget::widget()?>
    
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
        
        <? if ($dwg->obj->parent): ?>
            <!-- name parent -->
            <tr>
                <td>
                    Узел
                </td>
                <td>
                    <?= Html::a($dwg->obj->parent->name, ['/object', 'obj_id' => $dwg->obj->parent_id], ['targer' => '_blank']) ?>
                </td>   
            </tr>
        <? endif; ?>
        
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