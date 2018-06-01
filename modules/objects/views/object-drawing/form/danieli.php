<div class="panel panel-default" id="dwg-danieli-options-wrp" style="display:none;">
    <div class="panel-heading">Параметры чертежа Danieli</div>
    <div class="panel-body">
        <!-- revision dwg -->
        <?=$f->field($form, 'revisionDanieliDwg')->textInput()->label('Доработка чертежа:')?>

        <!-- sheet dwg -->
        <?=$f->field($form, 'sheetDanieliDwg')->textInput()->label('Лист чертежа:')?>

    </div>
</div>