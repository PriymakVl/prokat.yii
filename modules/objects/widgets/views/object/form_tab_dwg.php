<?php

use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
$this->registerJsFile('/js/drawing/dwg_form_show_options.js');
?>

<div id="form-tab-dwg" style="display:none;">

    <!-- category dwg -->
    <?php
        $items = ['' => 'Не выбран', 'department' => 'Цех', 'works' => 'ПКО'];
        echo $f->field($form, 'categoryDwg')->dropDownList($items)->label('Где создан чертеж(эскиз):');
    ?>
    
    <!-- name dwg -->
    <?=$f->field($form, 'nameDwg')->textInput()->label('Название чертежа:')?>
    
    <!-- file -->
    <?=$f->field($form, 'fileDwg')->fileInput()->label('Выбрать файл:')?> 
    
    <!-- dwg works options -->
    <div class="panel panel-default" id="dwg-works-options-wrp" style="display:none;">
        <div class="panel-heading">Параметры чертежа ПКО</div>
        <div class="panel-body">
            <!-- number dwg -->
            <?=$f->field($form, 'numberWorksDwg')->textInput()->label('Номер чертежа:')?>
            
            <!-- sheet dwg -->
            <?=$f->field($form, 'sheetWorksDwg')->textInput(['value' => '1'])->label('Лист чертежа:')?>
        </div>
    </div>
    
    <!-- dwg department options -->
    <div class="panel panel-default" id="dwg-department-options-wrp" style="display:none;">
        <div class="panel-heading">Параметры эскиза</div>
        <div class="panel-body">
            <!-- file kompas -->
            <?=$f->field($form, 'fileDwgKompas')->fileInput()->label('Выбрать файл компас:')?>
            
            <!-- desinger -->
            <?php
            $params = ['prompt' => 'Не выбран'];
                $designers = ['Приймак В.Н.' => 'Приймак В.Н.', 'Немер А.Г.' => 'Немер А.Г.'];
                echo $f->field($form, 'designerDepartmentDwg')->dropDownList($designers, $params)->label('Конструктор:');
            ?>
        </div>
    </div>
    
    <!-- note -->
    <?php
        if ($dwg) $form->note = $dwg->note;
        echo $f->field($form, 'noteDwg')->textarea(['rows' => '4'])->label('Примечание к чертежу:');
    ?>     
</div>


