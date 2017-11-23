<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
$this->registerJsFile('/js/drawing/dwg_form_show_options.js');
?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        Добавить чертеж
    </div>
    
    <!-- info -->
    <div class="info-box  margin-top-15">
        <span>Название детали/узла:</span>&laquo; <?=$obj->name?> &raquo;<br />
        <span>Код детали/узла:</span>&laquo; <?=$obj->code ? $obj->code : 'Не указан'?> &raquo;<br />
    </div>
    
    <!-- drawing form -->
    <div id="dwg-form-wrp" class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-object-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
            
            <!-- type -->
            <?php
                $items = ['department' => 'Цех', 'works' => 'ПКО', 'danieli' => 'Danieli', 'sundbirsta' => 'Sundbirsta', 
                    'standard_danieli' => 'Стандарт Danieli', 'standard' => 'Стандарт'];
                $params = ['prompt' => 'Не выбран'];
                echo $f->field($form, 'category')->dropDownList($items, $params)->label('Где создан чертеж(эскиз):');
            ?>
            
            <!-- dwg works options -->
            <div class="panel panel-default" id="dwg-works-options-wrp" style="display:none;">
                <div class="panel-heading">Параметры чертежа ПКО</div>
                <div class="panel-body">
                    <!-- number dwg -->
                    <?=$f->field($form, 'numberWorksDwg')->textInput()->label('Номер чертежа:')?>
                    
                    <!-- file sheet_1 -->
                    <?=$f->field($form, 'works_dwg_1')->fileInput()->label('Лист 1:')?> 

                    <!-- file sheet_2 -->
                    <?=$f->field($form, 'works_dwg_2')->fileInput()->label('Лист 2:')?>
                    
                    <!-- file sheet_3 -->
                    <?=$f->field($form, 'works_dwg_3')->fileInput()->label('Лист 3:')?>
                    
                    <!-- name dwg -->
                    <?=$f->field($form, 'nameWorksDwg')->textInput(['value' => $obj->name])->label('Название чертежа:')?>
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
            
            <!-- dwg danieli options -->
            <div class="panel panel-default" id="dwg-danieli-options-wrp" style="display:none;">
                <div class="panel-heading">Параметры чертежа Danieli</div>
                <div class="panel-body">
                    <!-- revision dwg -->
                    <?=$f->field($form, 'revisionDanieliDwg')->textInput()->label('Доработка чертежа:')?>
                    
                    <!-- sheet dwg -->
                    <?=$f->field($form, 'sheetDanieliDwg')->textInput()->label('Лист чертежа:')?>

                </div>
            </div>
            
            <!-- dwg standard danieli options -->
            <div class="panel panel-default" id="dwg-standard-danieli-options-wrp" style="display:none;">
                <div class="panel-heading">Параметры чертежа стандарт Danieli</div>
                <div class="panel-body">
                    <!-- name dwg -->
                    <?=$f->field($form, 'nameStandardDanieliDwg')->textInput()->label('Наименование чертежа:')?>
                </div>
            </div>

            <!-- note dwg -->
            <?php
                if ($dwg) $form->note = $dwg->noteDwg;
                echo $f->field($form, 'noteDwg')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
                      
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
            
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>

