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
    
    <!-- dwg works options -->
    <div class="panel panel-default" id="dwg-works-options-wrp" style="display:none;">
        <div class="panel-heading">Параметры чертежа ПКО</div>
        <div class="panel-body">
            <!-- number dwg -->
            <?=$f->field($form, 'numberWorksDwg')->textInput(['value' => $obj->code])->label('Номер чертежа ПКО:')?>

            <!-- name dwg -->
            <?=$f->field($form, 'nameWorksDwg')->textInput(['value' => $obj->name])->label('Название чертежа ПКО:')?>
                    
            <!-- file sheet_1 -->
            <?=$f->field($form, 'works_dwg_1')->fileInput()->label('Лист 1:')?>

            <!-- file sheet_2 -->
            <?=$f->field($form, 'works_dwg_2')->fileInput()->label('Лист 2:')?>

            <!-- file sheet_3 -->
            <?=$f->field($form, 'works_dwg_3')->fileInput()->label('Лист 3:')?>
        </div>
    </div>
    
    <!-- dwg department options -->
    <div class="panel panel-default" id="dwg-department-options-wrp" style="display:none;">
        <div class="panel-heading">Параметры эскиза</div>
        <div class="panel-body">
            <!-- file drawg -->
                    <?=$f->field($form, 'department_draft')->fileInput()->label('Файл эскиза:')?>
                    
                    <!-- file kompas -->
                    <?=$f->field($form, 'department_kompas')->fileInput()->label('Файл компас:')?>
                    
                    <!-- desinger -->
                    <?php
                    $params = ['prompt' => 'Не выбран'];
                        $designers = ['Приймак В.Н.' => 'Приймак В.Н.', 'Немер А.Г.' => 'Немер А.Г.'];
                        echo $f->field($form, 'designerDepartmentDwg')->dropDownList($designers, $params)->label('Конструктор:');
                    ?>
                    
                    <?=$f->field($form, 'nameDepartmentDwg')->textInput(['value' => $obj->name])->label('Название эскиза:')?>
        </div>
    </div>
    
    <!-- note -->
    <?php
        if ($dwg) $form->noteDwg = $dwg->note;
        echo $f->field($form, 'noteDwg')->textarea(['rows' => '4'])->label('Примечание к чертежу:');
    ?>     
</div>


