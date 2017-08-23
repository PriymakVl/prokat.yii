<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingListMenuWidget;
use app\modules\drawing\widgets\DepartmentFormTopMenuWidget;
use app\modules\drawing\widgets\DrawingFormTabWidget;

$this->registerCssFile('/css/drawign.css');
$this->registerCssFile('/css/object.css');
$this->registerJsFile('/js/drawing/dwg_form_show_tab.js');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($dwg): ?>
            Редакирование эскиза    
        <? else: ?>
            Добавление эскиза  
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?=DepartmentFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
         <? $f = ActiveForm::begin(['id' => 'form-department-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
        
            <!-- main tab -->
            <?=DrawingFormTabWidget::widget(['template' => 'form_tab_department', 'f' => $f, 'form' => $form, 'dwg' => $dwg])?>
            
            <!-- object tab -->
            <?=DrawingFormTabWidget::widget(['template' => 'form_tab_object', 'f' => $f, 'form' => $form, 'dwg' => $dwg])?>
            
            <!-- dimensions tab -->
            <?//=DrawingFormTabWidget::widget(['template' => 'form_tab_dimensions', 'f' => $f, 'form' => $form, 'dwg' => $dwg])?>
            
            <!-- hidden dwg id -->
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
	<?=DrawingListMenuWidget::widget()?>
</div>