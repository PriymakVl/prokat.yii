<?php

use yii\widgets\ActiveForm;
use app\components\other\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/drawing.css'); 
?>

<div class="content">
    <!-- title -->
    <div class="title-box">
        Добавить примечание
    </div>
    
    <!-- info -->
    <div class="info-box">
        <span>Файл чертежа:</span>&laquo; <?= $dwg->category == 'works' ? $file->file : $dwg->file ?> &raquo;<br />
    </div>
        
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-note-dwg']); ?>
            <!-- object drawign note -->
            <?php
                if ($dwg->category == 'works') $form->note = $file->note;
                else $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
            <!-- hidden -->
            <?//=$f->field($form, 'id')->hiddenInput(['value' => $dwg_id])->label(false) ?> 
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>