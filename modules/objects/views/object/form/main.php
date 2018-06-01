<div id="form-tab-main">

    <div class="border-bottom">
        <!-- engish name object-->
        <? if ($obj->eng) echo $f->field($form, 'eng')->textInput(['value' => $obj->eng, 'readonly' => 'readonly'])->label('Name object:'); ?>

        <!-- rusian name object -->
        <?= $f->field($form, 'rus')->textInput(['value' => $obj ? $obj->rus : ''])->label('Название объекта:') ?>

        <!-- names all change -->
        <? if ($obj): ?>
            <?= $f->field($form, 'all_name')->checkbox(['label' => 'Изменить название для всех']) ?>
        <? endif; ?>
    </div>

    <div class="pos-relative border-bottom">
        <!-- alias -->          
        <?= $f->field($form, 'alias')->textInput(['value' => $obj->alias, 'style' => 'width:250px'])->label('Короткое название объекта:')?>
    
        <!-- order name -->          
        <?= $f->field($form, 'order_name')->textInput(['value' => $obj->order_name, 'style' => 'width:350px'])->label('Название объекта в заказах:')?>
    </div>
    
    <div class="pos-relative border-bottom">
        <!-- code -->          
        <?=$f->field($form, 'code')->textInput(['value' => $obj ? $obj->code : '', 'style' => 'width:200px'])->label('Код объекта:'); ?>    

        <!-- item -->          
        <?= $f->field($form, 'item')->textInput(['value' => $obj ? $obj->item : '', 'style' => 'width:100px'])->label('Позиция:') ?>

        <!-- weight -->
        <?=$f->field($form, 'weight')->textInput(['value' => $obj ? $obj->weight : '', 'style' => 'width:100px'])->label('Вес(кг):'); ?>

        <!-- parent -->
        <?= $f->field($form, 'parent_id')->textInput(['value' => $obj ? $obj->parent_id : $parent_id, 'style' => 'width:100px'])->label('ID parent:') ?>
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
    

              
</div>
