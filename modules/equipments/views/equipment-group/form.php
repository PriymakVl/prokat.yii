<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;

//$this->registerCssFile('/css/drawing.css');


?>
<div class="content">
    <!-- title -->
    <div class="title-box">
            <?= $item ? 'Редакирование элемента' : 'Создание елемента' ?>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
         <? $f = ActiveForm::begin(['id' => 'form-equ-group']); ?>

                <!-- name -->
                <?=$f->field($form, 'name')->textInput(['value' => $item->name])->label('Название элемента:')?>
                
                <!-- alias -->
                <?=$f->field($form, 'alias')->textInput(['value' => $item->alias])->label('Краткое название элемента:')?>

                <!-- parent id -->
                <?=$f->field($form, 'parent_id')->textInput(['value' => $parent_id])->label('ID родителя:')?>

                <!-- rating -->
                <?=$f->field($form, 'rating')->textInput(['value' => $item->rating])->label('Рейтинг:')?>
    
                <!-- note -->
                <?php
                    if ($dwg) $form->note = $dwg->note;
                    echo $f->field($form, 'note')->textarea(['rows' => '4', 'value' => $item->note])->label('Примечание:');
                ?>
            
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