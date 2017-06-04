<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;
$this->registerCssFile('/css/object.css');
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
            <!-- engish name object-->
            <? if ($obj->eng) echo $f->field($form, 'eng')->textInput(['value' => $obj->eng, 'readonly' => 'readonly'])->label('Name object:'); ?>
			
			<!-- rusian name object -->          
            <?= $f->field($form, 'rus')->textInput(['value' => $obj ? $obj->rus : ''])->label('Название объекта:') ?>
			
			<!-- alias -->          
            <?= $f->field($form, 'alias')->textInput(['value' => $obj->alias, 'style' => 'width:250px'])->label('Короткое название объекта:')?>
			
			<!-- id object -->
			<?=$f->field($form, 'id')->textInput(['value' => $obj->id, 'readonly' => 'readonly', 'style' => 'width:100px'])->label('ID object:')?>
			
            <!-- code -->          
            <?=$f->field($form, 'code')->textInput(['value' => $obj->code, 'readonly' => 'readonly', 'style' => 'width:200px'])->label('Код объекта:'); ?>
            
			<!-- item -->          
            <?= $f->field($form, 'item')->textInput(['value' => $obj ? $obj->item : '', 'style' => 'width:100px'])->label('Позиция:') ?>
            
			<!-- rating -->          
            <?= $f->field($form, 'rating')->textInput(['value' => $obj ? $obj->rating : '', 'style' => 'width:100px'])->label('Рейтинг:') ?>
			
			<!-- parent -->          
            <?= $f->field($form, 'parent_id')->textInput(['value' => $obj ? $obj->parent_id : null, 'style' => 'width:100px'])->label('ID parent:') ?>
            
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