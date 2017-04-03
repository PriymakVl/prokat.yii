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
                $params = ['prompt' => 'Не выбран']; 
                echo $f->field($form, 'category')->dropDownList($form->categories, $params)->label('Кто разработал чертеж:');
            ?>
            <!-- dwg id -->          
            <?= $f->field($form, 'dwg_id')->textInput()->label('Id чертежа:') ?>
            
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

