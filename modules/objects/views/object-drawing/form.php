<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
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
        <? $f = ActiveForm::begin(['id' => 'form-object-dwg']); ?>
            <!-- type -->
            <?php
                $items = ['department' => 'Цех', 'works' => 'ПКО', 'standard' => 'Стандарт'];
                echo $f->field($form, 'category')->dropDownList($items)->label('Кто разработал чертеж:');
            ?>
            <!-- code object -->
            <div id="dwg-id-wrp">
                <?= $f->field($form, 'code')->textInput(['readonly' => 'readonly', 'value' => $obj->code])->label('Код детали:') ?>
            </div>
            
            <!-- dwg id -->
            <div id="dwg-id-wrp">
                <?= $f->field($form, 'dwg_id')->textInput()->label('Id чертежа:') ?>
            </div>
                      
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

