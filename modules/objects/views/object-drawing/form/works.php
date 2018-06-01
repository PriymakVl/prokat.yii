<div class="panel panel-default" id="dwg-works-options-wrp" style="display:none;">
    <div class="panel-heading">Параметры чертежа ПКО</div>
    <div class="panel-body">
        <!-- number dwg -->
        <?=$f->field($form, 'numberWorksDwg')->textInput(['value' => $obj->code])->label('Номер чертежа:')?>

        <!-- file sheet_1 -->
        <?=$f->field($form, 'works_dwg_1')->fileInput()->label('Лист 1:')?>

        <!-- file sheet_2 -->
        <?=$f->field($form, 'works_dwg_2')->fileInput()->label('Лист 2:')?>

        <!-- file sheet_3 -->
        <?=$f->field($form, 'works_dwg_3')->fileInput()->label('Лист 3:')?>

        <!-- name dwg -->
        <?=$f->field($form, 'nameWorksDwg')->textInput(['value' => $obj->name])->label('Название чертежа:')?>
    </div>
</div>