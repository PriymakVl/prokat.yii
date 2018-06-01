<?php

use yii\widgets\ActiveForm;
use yii\web\View;
use app\widgets\MainMenuWidget;

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
            
            <!-- dwg works -->
            <?=View::render('works', ['f' => $f, 'form' => $form, 'obj' => $obj])?>
            
            <!-- dwg department-->
            <?=View::render('department', ['f' => $f, 'form' => $form, 'obj' => $obj])?>

            <!-- dwg danieli -->
            <?=View::render('danieli', ['f' => $f, 'form' => $form, 'obj' => $obj])?>
            
            <!-- dwg standard danieli -->
            <?=View::render('danieli_standard', ['f' => $f, 'form' => $form, 'obj' => $obj])?>

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

