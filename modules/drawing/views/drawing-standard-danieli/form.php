<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;


$this->registerCssFile('/css/drawign.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
            Добавление чертежа стандарта Danieli  
    </div>
    
    <!-- info -->
    <? if ($result): ?>
        <div class="info-box">
            <span style="color: green;">Файл добавлен в базу</span>
        </div>
    <? endif; ?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-standard-danieli-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
           
            <!-- name -->          
            <?php 
                //$name = $dwg ? $dwg->name : ''; 
                echo $f->field($form, 'name')->textInput(['value' => $dwg->name])->label('Название чертежа:'); 
            ?>
            
            <!-- flle pdf -->
            <?= $f->field($form, 'pdf')->fileInput()->label('Файл pdf:') ?>
            
            <!-- flle txt -->
            <?= $f->field($form, 'txt')->fileInput()->label('Файл txt:') ?>
            
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