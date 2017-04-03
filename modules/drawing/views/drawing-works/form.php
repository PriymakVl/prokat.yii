<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;

$this->registerCssFile('/css/drawign.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($dwg): ?>
            Редакирование чертежа ПКО    
        <? else: ?>
            Добавление чертежа ПКО  
        <? endif; ?>
    </div>
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-works-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
            <!-- name -->          
            <?=$f->field($form, 'name')->textInput(['value' => $dwg->name])->label('Название чертежа:')?>
            
            <!-- number -->          
            <?=$f->field($form, 'number')->textInput(['value' => $dwg->number])->label('Номер чертежа:')?>
            
             <!-- item -->          
            <?=$f->field($form, 'item')->textInput(['value' => $dwg->item ? $dwg->item : 1])->label('Позиция в спецификации:')?>
            
            <!-- type -->
            <?php 
                $form->type = $dwg ? $dwg->type : 'drawing';
                $types = ['drawing' => 'Чертеж', 'folder' => 'Папка', 'assembly' => 'Сборочный чертеж', 'specification' => 'Спецификация'];
                echo $f->field($form, 'type')->dropDownList($types)->label('Тип:');
            ?>
            <!-- parent_id -->
            <?= $f->field($form, 'parent_id')->textInput(['value' => $dwg->parent_id ? $dwg->parent_id : 0])->label('ID родителя:') ?>
            
            <!-- sheets -->
            <?= $f->field($form, 'sheets')->textInput(['value' => $dwg->sheets ? $dwg->sheets : 1])->label('Количество листов:') ?>
            
            <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            
            <!-- hidden drawing id -->
            <?=$f->field($form, 'dwg_id')->hiddenInput(['value' => $dwg ? $dwg->id : false])->label(false) ?> 
            
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
            
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
</div>