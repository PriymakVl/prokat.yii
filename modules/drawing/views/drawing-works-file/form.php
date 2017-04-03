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
        <? if ($file): ?>
            Редакирование файла чертежа   
        <? else: ?>
            Добавление файла чертежа  
        <? endif; ?>
    </div>
    
    <!-- info -->
    <div class="info-box">
        <span>Название чережа:</span>&laquo; <?=$dwg->name?> &raquo;<br />
        <span>Номер чертежа:</span>&laquo; <?=$dwg->number?> &raquo;
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-works-dwg-file', 'options' => ['enctype'=>'multipart/form-data']]); ?>
        
            <!-- number sheet -->          
            <?=$f->field($form, 'sheet')->textInput(['value' => $file->sheet])->label('Номер листа:')?>
            
            <!-- flle -->
            <?= $f->field($form, 'file')->fileInput()->label('Файл чертежа:') ?>
            
            <!-- note -->
            <?php
                if ($dwg) $form->note = $file->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            
            <!-- hidden dwg id -->
            <?=$f->field($form, 'dwg_id')->hiddenInput(['value' => $dwg->id])->label(false) ?> 
            
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