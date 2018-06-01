<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingListMenuWidget;
use app\modules\drawing\widgets\DepartmentFormTopMenuWidget;
use app\modules\drawing\widgets\DrawingFormTabWidget;

$this->registerCssFile('/css/drawing.css');
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
            
            <div class="form-box-top-wrp">
                <!-- code -->
                <?=$f->field($form, 'code')->textInput(['value' => $dwg->code, 'style' => 'width:200px'])->label('Код детали:')?>
                
                <!-- number dwg -->
                <?=$f->field($form, 'number')->textInput(['value' => $dwg ? $dwg->number : $form->newNumber, 'style' => 'width:200px'])->label('Номер эскиза:')?>
            </div>

            <!-- name dwg -->
            <?=$f->field($form, 'name')->textInput(['value' => $dwg->name])->label('Название эскиза:')?>
           
            <!-- flle -->
            <div id="dwg-file-input-wrp">
                <!-- file with extension tif, jpeg, pdf --> 
                <?
                    $label = 'Файл эскиза: <span style="color:green">'.$dwg->file.'</span>';
                    echo $f->field($form, 'draft')->fileInput()->label($label);
                ?> 
                
                <!-- file with extension cdw compas-->
                <?
                    $label = 'Файл чертежа в компасе: <span style="color:green">'.$dwg->file_cdw.'</span>';
                    echo $f->field($form, 'kompas')->fileInput()->label($label);
                ?>
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