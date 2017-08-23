<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
$this->registerJsFile('/js/drawing/dwg_show_form_options.js');
?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        Добавить чертеж
    </div>
    
    <!-- info -->
    <div class="info-box">
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
            
            <!-- file -->
            <?=$f->field($form, 'file')->fileInput()->label('Выбрать файл:')?> 
            
            <div id="dwg-options-wrp" style="display:none;">
                <!-- number dwg -->
                <?=$f->field($form, 'numberDwg')->textInput()->label('Номер чертежа:')?>
                
                <!-- sheet dwg -->
                <?=$f->field($form, 'sheetDwg')->textInput()->label('Лист чертежа:')?>
                
                <!-- name dwg -->
                <?=$f->field($form, 'nameDwg')->textInput()->label('Название чертежа:')?>
            </div>
            
            
            <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
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

