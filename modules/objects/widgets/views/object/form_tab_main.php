<?php

use yii\helpers\Html;
use app\modules\objects\widgets\ObjectSelectMaterialWidget;

$this->registerCssFile('/css/object.css');
?>

<div id="form-tab-main">

    <!-- engish name object-->
    <? if ($obj->eng) echo $f->field($form, 'eng')->textInput(['value' => $obj->eng, 'readonly' => 'readonly'])->label('Name object:'); ?>
    
    <!-- rusian name object -->          
    <?= $f->field($form, 'rus')->textInput(['value' => $obj ? $obj->rus : ''])->label('Название объекта:') ?>
    
    <!-- names all change -->
    <? if ($obj): ?>
        <?= $f->field($form, 'all_name')->checkbox(['label' => 'Изменить название для всех']) ?>
    <? endif; ?>
    
    <div class="pos-relative">
        <!-- alias -->          
        <?= $f->field($form, 'alias')->textInput(['value' => $obj->alias, 'style' => 'width:250px'])->label('Короткое название объекта:')?>
    
        <!-- order name -->          
        <?= $f->field($form, 'order_name')->textInput(['value' => $obj->order_name, 'style' => 'width:350px'])->label('Название объекта в заказах:')?>
    </div>
    
    <!-- id object -->
    <?//=$f->field($form, 'id')->textInput(['value' => $obj ? $obj->id : '', 'readonly' => 'readonly', 'style' => 'width:100px'])->label('ID object:')?>
    
    <div class="pos-relative">
        <!-- code -->          
        <?=$f->field($form, 'code')->textInput(['value' => $obj ? $obj->code : '', 'style' => 'width:200px'])->label('Код объекта:'); ?>    
       
        <!-- parent -->          
        <?= $f->field($form, 'parent_id')->textInput(['value' => $obj ? $obj->parent_id : $parent_id, 'style' => 'width:100px'])->label('ID parent:') ?>
        
        <!-- item -->          
        <?= $f->field($form, 'item')->textInput(['value' => $obj ? $obj->item : '', 'style' => 'width:100px'])->label('Позиция:') ?>
        
        <!-- rating -->          
        <?= $f->field($form, 'rating')->textInput(['value' => $obj ? $obj->rating : '', 'style' => 'width:100px'])->label('Рейтинг:') ?>
    </div>
    

    <div class="pos-relative">
        <!-- weight -->          
        <?=$f->field($form, 'weight')->textInput(['value' => $obj ? $obj->weight : '', 'style' => 'width:100px'])->label('Вес(кг):'); ?>
    
        <!-- qty -->          
        <?=$f->field($form, 'qty')->textInput(['value' => $obj ? $obj->qty : '1', 'style' => 'width:100px'])->label('Количество:'); ?>
    
    </div> 
    
    <div class="pos-relative">
        <!-- material -->          
        <?=$f->field($form, 'material')->textInput(['value' => $obj->material, 'style' => 'width:150px'])->label('Материал:'); ?>
    
        <!-- select material -->
        <?=ObjectSelectMaterialWidget::widget(['template' => 'material'])?>
        
        <!-- analog -->          
        <?=$f->field($form, 'analog')->textInput(['value' => $obj->analog, 'style' => 'width:150px'])->label('Аналог материала:'); ?>
    
        <!-- select analog -->
        <?=ObjectSelectMaterialWidget::widget(['template' => 'analog'])?>
    </div>   

    <div class="pos-relative">
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
    </div>
    
    <!-- note -->
    <?php
        if ($obj) $form->note = $obj->note;
        echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
              
</div>
