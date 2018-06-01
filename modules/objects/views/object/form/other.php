<div id="form-tab-other" style="display: none">
    <div class="pos-relative border-bottom">
        <!-- qty -->
        <?=$f->field($form, 'qty')->textInput(['value' => $obj ? $obj->qty : '1', 'style' => 'width:100px'])->label('Количество:'); ?>

        <!-- rating -->
        <?= $f->field($form, 'rating')->textInput(['value' => $obj ? $obj->rating : '', 'style' => 'width:100px'])->label('Рейтинг:') ?>
    </div>
    <!-- note -->
    <?php
        if ($obj) $form->note = $obj->note;
        echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
</div>