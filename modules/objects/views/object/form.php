<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use app\modules\objects\widgets\ObjectFormTopMenuWidget;
use app\modules\objects\widgets\ObjectFormTabWidget;

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
    <?=ObjectFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
         <? $f = ActiveForm::begin(['id' => 'form-object', 'options' => ['enctype'=>'multipart/form-data']]); ?>
        
            <!-- main tab -->
            <?=ObjectFormTabWidget::widget(['template' => 'object/form_tab_main', 'f' => $f, 'form' => $form, 'obj' => $obj, 'parent_id' => $parent_id])?>
            
            <!-- drawing tab -->
            <?=ObjectFormTabWidget::widget(['template' => 'object/form_tab_dwg', 'f' => $f, 'form' => $form, 'obj' => $obj])?>
            
            <!-- dimensions tab -->
            <?//=ObjectFormTabWidget::widget(['template' => 'form_tab_dimensions', 'f' => $f, 'form' => $form, 'obj' => $obj])?>
            
            <!-- hidden dwg id -->
            <?=$f->field($form, 'obj_id')->hiddenInput(['value' => $obj ? $obj->id : ''])->label(false) ?>
            
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