<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

?>

<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($obj): ?>
            Редакирование объекта    
        <? else: ?>
            Создание нового объекта
        <? endif; ?>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-object']); ?>
            <!-- eng and id of object-->
            <?
                if ($obj) {
                    echo $f->field($form, 'eng')->textInput(['value' => $obj->eng, 'readonly' => 'readonly'])->label('Name object:');
                    echo $f->field($form, 'id')->textInput(['value' => $obj->id, 'readonly' => 'readonly'])->label('ID object:');    
                }
            ?>
            <!-- code -->          
            <? if (!$obj->code) echo $f->field($form, 'code')->textInput()->label('Код объекта:'); ?>
            <!-- rus -->          
            <?= $f->field($form, 'rus')->textInput(['value' => $obj ? $obj->rus : ''])->label('Название объекта:') ?>
            <!-- alias -->          
            <?= $f->field($form, 'alias')->textInput(['value' => $obj->alias])->label('Короткое название объекта:')->hint('Указывается в хлебных крошках') ?>
            <!-- item -->          
            <?= $f->field($form, 'item')->textInput(['value' => $obj ? $obj->item : ''])->label('Позиция объекта в спецификации:') ?>
            <!-- rating -->          
            <?= $f->field($form, 'rating')->textInput(['value' => $obj ? $obj->rating : ''])->label('Рейтинг объекта:') ?>
            <!-- type -->
            <?php
                $params = ['prompt' => 'Не выбран']; 
                if ($obj) $form->type = $obj->type;
                echo $f->field($form, 'type')->dropDownList($form->types, $params)->label('Тип объекта:');
            ?>
            <!-- equipment -->
            <?php
                $params = ['prompt' => 'Не выбран']; 
                if ($obj) $form->equipment = $obj->equipment;
                echo $f->field($form, 'equipment')->dropDownList($form->equipments, $params)->label('Оборудование объекта:');
            ?>
            <!-- note -->
            <?php
                if ($obj) $form->note = $obj->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            <!-- parent -->          
            <?= $f->field($form, 'parent_id')->textInput(['value' => $obj ? $obj->parent_id : null])->label('ID parent:') ?>
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
            <!-- hidden -->
            <?=$f->field($form, 'id')->hiddenInput(['value' => $obj ? $obj->id : false])->label(false) ?> 
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>