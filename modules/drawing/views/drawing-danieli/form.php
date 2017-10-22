<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        Редактировать чертеж Danieli
    </div>
    
    <!-- info -->
    <div class="info-box">
        <span>Название детали/узла:</span>&laquo; <?=$obj->name?> &raquo;<br />
        <span>Код детали/узла:</span>&laquo; <?=$obj->code ? $obj->code : 'Не указан'?> &raquo;<br />
        <span>Название файла:</span>&laquo; <?=$dwg->file?> &raquo;
    </div>
    
    <!-- update vendor form -->
    <div id="dwg-form-wrp" class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'update-vendor-dwg']); ?>

            <!-- dwg data vendor -->
            <div id="dwg-vendor-wrp">
                
                <?= $f->field($form, 'sheet')->textInput(['value' => $dwg->sheet])->label('Номер листа:') ?>
                
                <?= $f->field($form, 'sheets')->textInput(['value' => $dwg->sheets])->label('Количество листвов:') ?>
                
                <?= $f->field($form, 'revision')->textInput(['value' => $dwg->revision])->label('Номер доработки:') ?>
                
                <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
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

