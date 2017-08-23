<?php

//$this->registerJsFile('js/order/form_show_tab.js');

?>

<div id="form-tab-department">
    <!-- id object -->
	<?=$f->field($form, 'obj_id')->textInput(['value' => $obj ? $obj->id : '', 'style' => 'width:100px'])->label('ID детали:')?>
    
    <!-- parent -->          
    <?= $f->field($form, 'obj_parent_id')->textInput(['value' => $obj ? $obj->parent_id : null, 'style' => 'width:100px'])->label('ID родителя:') ?>
    
    <!-- rusian name object -->          
    <?= $f->field($form, 'rus')->textInput(['value' => $obj ? $obj->rus : ''])->label('Название детали:') ?>
    
    <!-- name -->          
    <?php 
        //echo $f->field($form, 'name')->textInput(['value' => $dwg ? $dwg->name : ''])->label('Название эскиза:'); 
    ?>
	
	<!-- alias -->
	<?php 
        //echo $f->field($form, 'alias')->textInput(['value' => $dwg ? $dwg->alias : ''])->label('Короткое название эскиза:'); 
    ?>
	
    <!-- type -->
    <?php 
        //$form->type = $dwg ? $dwg->type : 'file';
//        $types = ['file' => 'Файл', 'folder' => 'Папка'];
//        echo $f->field($form, 'type')->dropDownList($types)->label('Тип:');
    ?>
    <!-- parent_id -->
    <?//=$f->field($form, 'parent_id')->textInput(['value' => $dwg->parent_id ? $dwg->parent_id : 0])->label('ID родителя:') ?>
   
    <!-- flle -->
    <div id="dwg-file-input-wrp" <? if ($dwg->type == 'folder') echo 'style="display:none;"'; ?>>
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
    //$params = ['prompt' => 'Не выбран'];
//            $designers = ['Приймак' => 'Приймал В.Н.', 'Немер' => 'Немер А.Г.'];
//            if ($dwg) $form->designer = $dwg->designer;
//            echo $f->field($form, 'designer')->dropDownList($designers, $params)->label('Конструктор:');
    ?>
    <!-- note -->
    <?php
        //if ($dwg) $form->note = $dwg->note;
//        echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
</div><!-- tab-main -->