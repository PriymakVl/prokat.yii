<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;

$this->registerCssFile('/css/drawing.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($dwg): ?>
            Редакирование чертежа ПКО для объекта <?=$dwg->obj->name?>  
        <? else: ?>
            Добавление чертежа ПКО  
        <? endif; ?>
    </div>
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-works-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
            <div id="top-box-wrp">
                 <!-- number dwg -->          
                <?=$f->field($form, 'numberWorksDwg')->textInput(['value' => $dwg->number, 'maxlength'=>50, 'style' => 'width:200px'])->label('Номер чертежа:')?>
            
                <!-- code object -->          
                <?=$f->field($form, 'code')->textInput(['value' => $dwg->code, 'maxlength'=>50, 'style' => 'width:200px'])->label('Код объекта:')?>
                
            </div>
           
            <!-- name dwg -->          
            <?=$f->field($form, 'nameWorksDwg')->textInput(['value' => $dwg->name])->label('Название чертежа:')?>
            
            <!-- file sheet_1 -->
            <?=$f->field($form, 'works_dwg_1')->fileInput()->label('Лист 1:')?> 

            <!-- file sheet_2 -->
            <?=$f->field($form, 'works_dwg_2')->fileInput()->label('Лист 2:')?>
            
            <!-- file sheet_3 -->
            <?=$f->field($form, 'works_dwg_3')->fileInput()->label('Лист 3:')?>
            
            <!-- note -->
            <?php
                if ($dwg) $form->noteDwg = $dwg->note;
                echo $f->field($form, 'noteDwg')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            
            <!-- hidden drawing id -->
            <?=$f->field($form, 'dwg_id')->hiddenInput(['value' => $dwg ? $dwg->id : false])->label(false) ?> 
            
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