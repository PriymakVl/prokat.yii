<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\web\View;

$this->registerCssFile('/css/object.css');
$this->registerJsFile('/js/object/form_show_tab.js');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($obj): ?>
            Редакирование детали(узла)    
        <? else: ?>
            Добавление детали(узла)  
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?=View::render('topmenu');?>
    
    <!-- form -->
    <div class="form-wrp">
         <? $f = ActiveForm::begin(['id' => 'form-object', 'options' => ['enctype'=>'multipart/form-data']]); ?>
        
            <!-- main tab -->
            <?=View::render('main', ['f' => $f, 'order' => $order, 'form' => $form, 'obj' => $obj, 'parent_id' => $parent_id])?>

            <!-- drawing tab -->
            <?=View::render('drawing', ['f' => $f, 'order' => $order, 'form' => $form, 'obj' => $obj])?>

            <!-- other tab -->
            <?=View::render('other', ['f' => $f, 'order' => $order, 'form' => $form, 'obj' => $obj])?>

            <!-- material tab -->
            <?=View::render('material', ['f' => $f, 'order' => $order, 'form' => $form, 'obj' => $obj])?>
            
            <!-- dimensions tab -->
            <?//=ObjectFormTabWidget::widget(['template' => 'form_tab_dimensions', 'f' => $f, 'form' => $form, 'obj' => $obj])?>
            
            <!-- hidden obj id -->
            <?//=$f->field($form, 'obj_id')->hiddenInput(['value' => $obj ? $obj->id : ''])->label(false) ?>
            
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