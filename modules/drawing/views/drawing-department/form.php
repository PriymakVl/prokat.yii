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
            Редакирование эскиза    
    </div>
    
    <!-- top menu -->
    <?//=DepartmentFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
         <? $f = ActiveForm::begin(['id' => 'form-department-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
        
            <!-- id object -->
            <?=$f->field($form, 'obj_id')->textInput(['value' => $obj ? $obj->id : '', 'style' => 'width:100px'])->label('ID обекта:')?>
           
           <? if ($obj): ?>
               <!-- name object -->
               <div class="form-group">
                    <label class="control-label">Название объекта</label>
                    <?= Html::input('text', '', $obj->name, ['class' => 'form-control', 'disabled' => 'disabled']) ?>    
               </div>
            <? endif; ?>
           
           <!-- number dwg -->
           <div class="form-group">
                <label class="control-label">Номер эскиза</label>
                <?= Html::input('text', '', $dwg->fullNumber, ['class' => 'form-control', 'style' => 'width:150px', 'disabled' => 'disabled']) ?>    
           </div>
           
            <!-- name dwgt -->
            <?=$f->field($form, 'name')->textInput(['value' => $dwg->name])->label('Название чертежа:')?>
           
            <!-- flle -->
            <div id="dwg-file-input-wrp">
                <!-- file with extension tif, jpeg, pdf --> 
                <?= $f->field($form, 'file')->fileInput()->label('Файл эскиза:') ?>
                
                <!-- file with extension cdw compas-->
                <?//= $f->field($form, 'file_cdw')->fileInput()->label('Файл чертежа в компасе:') ?>
            </div> 
            
            <!-- service -->
            <?php
                //$form->service = $dwg->service ? $dwg->service : '';
                //echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
            ?>
            
            <!-- desinger -->
            <?php
            $params = ['prompt' => 'Не выбран'];
                    $designers = ['Приймак В.Н.' => 'Приймак В.Н.', 'Немер А.Г.' => 'Немер А.Г.'];
                    if ($dwg) $form->designer = $dwg->designer;
                    echo $f->field($form, 'designer')->dropDownList($designers, $params)->label('Конструктор:');
            ?>
    
            <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            
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