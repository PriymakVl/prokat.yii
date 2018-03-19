<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;

$this->registerCssFile('/css/inventory.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <?= $inv ? 'Редакирование инвентарного номера' : 'Создание инвентарного номера'?>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-inventory']);?>
            
            <!-- name -->          
            <?=$f->field($form, 'name')->textInput(['value' => $inv->name])->label('Наименование')?>
        
            <!-- number -->          
            <?=$f->field($form, 'number')->textInput(['value' => $inv->number, 'style' => 'width:150px'])->label('Инвентарный номер:')?>
        
            <!-- category -->
            <?php 
                $form->category = $inv ? $inv->category : '';
                echo $f->field($form, 'category')->dropDownList($form->categories)->label('Категория:');
            ?>
            
            <!-- obj id -->          
            <?=$f->field($form, 'obj_id')->textInput(['value' => $inv->obj_id, 'style' => 'width:120px'])->label('ID объекта:')?>
            
            <!-- rating -->          
            <?=$f->field($form, 'rating')->textInput(['value' => $inv->rating, 'style' => 'width:120px'])->label('Рейтинг:')?>

            <!-- note -->
            <?=$f->field($form, 'note')->textarea(['rows' => '4', 'value' => $inv->note])->label('Примечание:')?>
        
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