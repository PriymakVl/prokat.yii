<?
    $this->registerJsFile('/js/order/content_form_dimensions.js');
?>
<div id="content-form-dimensions" style="display:none;">
    <!-- type dimensions -->
    <?php
        $items = ['shaft' => 'Вал', 'bush' => 'Втулка', 'bar' => 'Планка', 'bolt'=>'Болт', 'nut' => 'Гайка'];
        $params = ['prompt' => 'Не выбран']; 
        $form->type_dimensions = $item->dimensions['type']; 
        echo $f->field($form, 'type_dimensions')->dropDownList($items, $params)->label('Тип детали:');
    ?>
    <!-- nut dimesions --> 
    <div id="nut-dimensions-wrp" <?=($item->dimensions['type'] == 'nut') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры гайки</h4>
        <?=$f->field($form, 'nut_thread')->textInput(['value' => ($item->dimensions['type'] == 'nut') ? $item->dimensions['thread'] : ''])->label('Резьба:')?>
        <?=$f->field($form, 'nut_pitch')->textInput(['value' => ($item->dimensions['type'] == 'nut') ? $item->dimensions['thread'] : ''])->label('Шаг резьбы:')?>
    </div> 
    
    <!-- bolt dimesions --> 
    <div id="bolt-dimensions-wrp" <?=($item->dimensions['type'] == 'bolt') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры болта</h4>
        <?=$f->field($form, 'bolt_thread')->textInput(['value' => ($item->dimensions['type'] == 'bolt') ? $item->dimensions['thread'] : ''])->label('Резьба:')?>
        <?=$f->field($form, 'bolt_pitch')->textInput(['value' => ($item->dimensions['type'] == 'bolt') ? $item->dimensions['pitch'] : ''])->label('Шаг резьбы:')?>
        <?=$f->field($form, 'bolt_length')->textInput(['value' => ($item->dimensions['type'] == 'bolt') ? $item->dimensions['thread'] : ''])->label('Длина:')?>
    </div> 
    
    <!-- shaft dimesions --> 
    <div id="shaft-dimensions-wrp" <?=($item->dimensions['type'] == 'shaft') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры вала</h4>
        <?=$f->field($form, 'shaft_length')->textInput(['value' => ($item->dimensions['type'] == 'shaft') ? $item->dimensions['length'] : ''])->label('Длина:')?>
        <?=$f->field($form, 'shaft_diam')->textInput(['value' => ($item->dimensions['type'] == 'shaft') ? $item->dimensions['diam'] : ''])->label('Наибольший диаметр:')?>
    </div>  
    
<!-- bar dimesions --> 
<div id="bar-dimensions-wrp" <?=($item->dimensions['type'] == 'bar') ? '' : 'style="display:none;"'?>>
    <h4>Габаритные размеры планки</h4>
    <?=$f->field($form, 'bar_length')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['length'] : ''])->label('Длина:')?>
    <?=$f->field($form, 'bar_height')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['height'] : ''])->label('Высота:')?>
    <?=$f->field($form, 'bar_width')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['width'] : ''])->label('Ширина:')?>
</div> 
    
    <!-- bush dimesions --> 
    <div id="bush-dimensions-wrp" <?=($item->dimensions['type'] == 'bush') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры втулки</h4>
        <?=$f->field($form, 'bush_height')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['height'] : ''])->label('Высота:')?>
        <?=$f->field($form, 'bush_in_diam')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['in_diam'] : ''])->label('Внутренний диаметр:')?>
        <?=$f->field($form, 'bush_out_diam')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['out_diam'] : ''])->label('Наружний диаметр:')?>
    </div>    
</div>