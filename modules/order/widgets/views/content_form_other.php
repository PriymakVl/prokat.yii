<div id="content-form-other" style="display:none;">
    <!-- category of drawing -->
    <?php 
        $params = ['prompt' => 'Невыбран'];
        $categories = ['vendor' => 'Производитель', 'works' => 'ПКО комбината', 'department' => 'Цех', 'standard' => 'Стандарт'];
        $form->cat_dwg = $item->cat_dwg;
        echo $f->field($form, 'cat_dwg')->dropDownList($categories, $params)->label('Кто разработал чертеж:');
    ?>
    
    <!-- category of drawing -->
    <?php 
        $params = ['prompt' => 'Невыбран'];
        $equipments = ['danieli' => 'Danieli', 'sundbirsta' => 'Sundbirsta', 'crane' => 'Краны', 'gydro' => 'Гидравлика'];
        $form->equipment = $item->equipment;
        echo $f->field($form, 'equipment')->dropDownList($equipments, $params)->label('Производитель оборудования:');
    ?>
    
     <!-- drawing file -->          
    <?=$f->field($form, 'file')->textInput(['value' => $item->file])->label('Файл чертежа:')?>
    
    <!-- rating -->          
    <?=$f->field($form, 'rating')->textInput(['value' => $item->rating])->label('Рейтинг:')?>
   
   
   <!-- note -->
    <?php
        if ($item) $form->note = $item->note;
        echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
</div><!-- main-content -->