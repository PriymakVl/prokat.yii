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
		<?=$f->field($form, 'nut_class')->textInput(['value' => ($item->dimensions['type'] == 'nut') ? $item->dimensions['class'] : ''])->label('Класс прочности:')?>
    </div> 
    
    <!-- bolt dimesions --> 
    <div id="bolt-dimensions-wrp" <?=($item->dimensions['type'] == 'bolt') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры болта</h4>
        <!-- bolt thread --> 
        <?php
            $items = ['6'=>'М6', '8' => 'М8', '10' => 'М10', '12'=>'М12', '14' => 'М14', '16' => 'М16', '18' => 'М18', '20' => 'М20', '22' => 'М22',
                    '24' => 'М24', '27' => 'М27', '30' => 'М30', '36' => 'М36', '42' => 'М42', '48' => 'М48'];
            $params = ['prompt' => 'Не выбран']; 
            $form->bolt_thread = $item->dimensions['thread']; 
            echo $f->field($form, 'bolt_thread')->dropDownList($items, $params)->label('Диаметр резьбы:');
        ?>
        
        <!-- bolt pitch -->
        <?php
            $items = ['0,5'=>'0,5', '0,75' => '0,75', '1' => '1', '1,25'=>'1,25', '1,5' => '1,5', '2' => '2', '3' => '3'];
            $params = ['prompt' => 'Не выбран']; 
            $form->bolt_pitch = $item->dimensions['pitch'];
            echo $f->field($form, 'bolt_pitch')->dropDownList($items, $params)->label('Шаг резьбы:');
        ?>
        
        <!-- bolt length -->
        <?php
            $items = ['10'=>'10', '14' => '14', '16' => '16', '20'=>'20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45',
                    '50' => '55', '60' => '60', '65' => '65', '70' => '70', '75' => '75', '80' => '80', '85' => '85', '90' => '90', '95' => '95',
                    '100' => '100', '105' => '105', '110' => '110', '115' => '115', '120' => '120', '125' => '125', '130' => '130', '140' => '140',
                     '150' => '150', '160' => '160', '170' => '170', '180' => '180', '190' => '190', '200' => '200',];
            $params = ['prompt' => 'Не выбран']; 
            $form->bolt_length = $item->dimensions['length'];
            echo $f->field($form, 'bolt_length')->dropDownList($items, $params)->label('Длина болта:');
        ?>
       
       <!-- bolt class -->
        <?php
            $items = ['4.8'=>'4.8', '5.8' => '5.8', '8.8' => '8.8', '10.9'=>'10.9', '12.9' => '12.9'];
            $params = ['prompt' => 'Не выбран']; 
            $form->bolt_class = $item->dimensions['class'];
            echo $f->field($form, 'bolt_class')->dropDownList($items, $params)->label('Класс прочности:');
        ?>
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
        <?=$f->field($form, 'bar_width')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['width'] : ''])->label('Ширина:')?>
        <?=$f->field($form, 'bar_length')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['length'] : ''])->label('Длина:')?>
        <?=$f->field($form, 'bar_height')->textInput(['value' => ($item->dimensions['type'] == 'bar') ? $item->dimensions['height'] : ''])->label('Толщина:')?>
    </div> 
    
    <!-- bush dimesions --> 
    <div id="bush-dimensions-wrp" <?=($item->dimensions['type'] == 'bush') ? '' : 'style="display:none;"'?>>
        <h4>Габаритные размеры втулки</h4>
        <?=$f->field($form, 'bush_height')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['height'] : ''])->label('Высота:')?>
        <?=$f->field($form, 'bush_in_diam')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['in_diam'] : ''])->label('Внутренний диаметр:')?>
        <?=$f->field($form, 'bush_out_diam')->textInput(['value' => ($item->dimensions['type'] == 'bush') ? $item->dimensions['out_diam'] : ''])->label('Наружний диаметр:')?>
    </div>    
</div>