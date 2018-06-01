<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/list.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
            Редакирование элемента списка    
    </div>
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-item-list']); ?>
            <!-- name -->          
            <?=$f->field($form, 'name')->textInput(['value' => $item->name])->label('Название элемента:')?>
            <!-- code -->          
            <?=$f->field($form, 'code')->textInput(['value' => $item->code])->label('Код элемента:')?>
            <!-- rating -->          
            <?=$f->field($form, 'rating')->textInput(['value' => $item->rating])->label('Рейтинг элемента:')->hint('Влияет на позицию элемента в списке')?>
            <!-- description -->
            <?php
                $form->note = $item->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="location.href='http://' + location.host;" /> 
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>