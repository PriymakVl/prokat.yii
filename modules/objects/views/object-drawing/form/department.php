<div class="panel panel-default" id="dwg-department-options-wrp" style="display:none;">
    <div class="panel-heading">Параметры эскиза</div>
    <div class="panel-body">
        <!-- number draft -->
        <?=$f->field($form, 'numberDepartmentDwg')->textInput(['value' => $form->newNumberDepartmentDwg])->label('Номер эскиза:')?>

        <!-- name draft -->
        <?=$f->field($form, 'nameDepartmentDwg')->textInput(['value' => $obj->name])->label('Название эскиза:')?>
        <!-- file draft -->
        <?=$f->field($form, 'department_draft')->fileInput()->label('Файл эскиза:')?>

        <!-- file kompas -->
        <?=$f->field($form, 'department_kompas')->fileInput()->label('Файл компас:')?>

        <!-- desinger draft -->
        <?php
        $params = ['prompt' => 'Не выбран'];
        $designers = ['Приймак В.Н.' => 'Приймак В.Н.', 'Немер А.Г.' => 'Немер А.Г.'];
        echo $f->field($form, 'designerDepartmentDwg')->dropDownList($designers, $params)->label('Конструктор:');
        ?>
    </div>
</div>