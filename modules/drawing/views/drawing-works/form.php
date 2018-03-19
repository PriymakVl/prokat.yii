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
            <div class="form-box-top-wrp">
                 <!-- number dwg -->          
                <?=$f->field($form, 'number')->textInput(['value' => $dwg->number, 'maxlength'=>50, 'style' => 'width:200px'])->label('Номер чертежа:')?>
            
                <!-- code object -->          
                <?=$f->field($form, 'code')->textInput(['value' => $dwg->code, 'maxlength'=>50, 'style' => 'width:150px'])->label('Код объекта:')?>

                <!-- parent id -->
                <?=$f->field($form, 'parent_id')->textInput(['value' => $dwg->parent_id, 'maxlength'=>50, 'style' => 'width:100px'])->label('ID parent:')?>
            </div>
           
            <!-- name dwg -->          
            <?=$f->field($form, 'name')->textInput(['value' => $dwg->name])->label('Название чертежа:')?>
            
            <!-- file sheet_1 -->
            <?php $labeltitle_1 = $dwg ? 'Лист 1: <span class="green">'.$dwg->sheet_1.'</span>' : 'Лист 1:'; ?>
            <?=$f->field($form, 'sheet_1')->fileInput()->label($labeltitle_1)?>

            <!-- file sheet_2 -->
            <?php $labeltitle_2 = $dwg ? 'Лист 2: <span class="green">'.$dwg->sheet_2.'</span>' : 'Лист 2:'; ?>
            <?=$f->field($form, 'sheet_2')->fileInput()->label($labeltitle_2)?>
            
            <!-- file sheet_3 -->
            <?php $labeltitle_3 = $dwg ? 'Лист 3: <span class="green">'.$dwg->sheet_3.'</span>' : 'Лист 3:'; ?>
            <?=$f->field($form, 'sheet_3')->fileInput()->label($labeltitle_3)?>
            
            <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
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