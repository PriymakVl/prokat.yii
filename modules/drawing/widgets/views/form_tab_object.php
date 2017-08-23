<div id="form-tab-object" style="display:none;">
	
	<!-- alias -->          
    <?= $f->field($form, 'obj_alias')->textInput(['value' => $obj->alias, 'style' => 'width:250px'])->label('Короткое название детали:')?>
    
    <!-- order name -->          
    <?= $f->field($form, 'order_name')->textInput(['value' => $obj->order_name, 'style' => 'width:250px'])->label('Название детали в заказах:')?>
	
    <!-- code -->          
    <?=$f->field($form, 'obj_code')->textInput(['value' => $obj ? $obj->code : '', 'style' => 'width:200px'])->label('Код объекта:'); ?>
	
	<!-- weight -->          
    <?=$f->field($form, 'obj_weight')->textInput(['value' => $obj ? $obj->weight : '', 'style' => 'width:200px'])->label('Вес,кг'); ?>
	
	<!-- qty -->          
    <?=$f->field($form, 'obj_qty')->textInput(['value' => $obj ? $obj->qty : '1', 'style' => 'width:200px'])->label('Количество,шт'); ?>
    
	<!-- item -->          
    <?= $f->field($form, 'obj_item')->textInput(['value' => $obj ? $obj->item : '', 'style' => 'width:100px'])->label('Позиция:') ?>
	
	<!-- type -->
    <?php
        $params = ['prompt' => 'Не выбран']; 
        if ($obj) $form->type = $obj->type;
        echo $f->field($form, 'obj_type')->dropDownList($form->types, $params)->label('Тип объекта:');
    ?>
    
	<!-- equipment -->
    <?php
        $params = ['prompt' => 'Не выбран']; 
        if ($obj) $form->equipment = $obj->equipment;
        echo $f->field($form, 'obj_equipment')->dropDownList($form->equipments, $params)->label('Оборудование объекта:');
    ?>
    
    <!-- note -->
    <?php
        if ($obj) $form->note = $obj->note;
        echo $f->field($form, 'obj_note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
</div>
            