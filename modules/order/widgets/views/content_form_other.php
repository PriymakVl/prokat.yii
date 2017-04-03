<div id="content-form-other" style="display:none;">
    <!-- category of drawing -->
    <?php 
        $form->cat_dwg = $item ? $item->cat_dwg : 'vendor';
        $categories = ['vendor' => 'Производитель', 'works' => 'ПКО комбината', 'department' => 'Цех'];
        echo $f->field($form, 'cat_dwg')->dropDownList($categories)->label('Кто разработал чертеж:');
    ?>
    
    <!-- category of drawing -->
    <?php 
        $form->equipment = $item ? $item->equipment : 'danieli';
        $equipments = ['danieli' => 'Danieli', 'sundbirsta' => 'Sundbirsta', 'crane' => 'Краны'];
        echo $f->field($form, 'equipment')->dropDownList($equipments)->label('Производитель оборудования:');
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