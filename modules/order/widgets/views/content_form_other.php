<?
    $this->registerJsFile('/js/order/set_new_number_department_dwg.js');
?>
<div id="content-form-other" style="display:none;">

    <div id="order-dwg-options-wrp">
        <!-- category of drawing -->
        <?php
            $items = ['department' => 'Цех', 'works' => 'ПКО', 'danieli' => 'Danieli', 'sundbirsta' => 'Sundbirsta', 
                'standard_danieli' => 'Стандарт Danieli', 'standard' => 'Стандарт'];
            $params = ['prompt' => 'Не выбран', 'style' => 'width:200px'];
            $form->cat_dwg = $item->cat_dwg;
            echo $f->field($form, 'cat_dwg')->dropDownList($items, $params)->label('Где создан чертеж:');
        ?>
        
        <!-- type dwg -->
        <?//=$f->field($form, 'type_dwg')->checkbox(['value' => 'new', 'label' => 'Новый чертеж:', 'department_number' => $form->newFullNumberDepartmentDwg])?>
        
         <!-- drawing name of file -->          
        <?=$f->field($form, 'filename')->textInput(['value' => $item->file, 'style' => 'width:200px;'])->label('Файл чертежа:')?>
    
        <!-- drawing file -->
        <?=$f->field($form, 'file')->fileInput()->label('Выбрать файл:')?>
    </div>
    
    
    <!-- rating -->          
    <?=$f->field($form, 'rating')->textInput(['value' => $item->rating])->label('Рейтинг:')?>
    
    <!-- code of object -->
    <?=$f->field($form, 'code')->textInput(['value' => $item->code])->label('Код объекта:')?>
   
   
   <!-- note -->
    <?php
        if ($item) $form->note = $item->note;
        echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
    ?>
</div><!-- main-content -->