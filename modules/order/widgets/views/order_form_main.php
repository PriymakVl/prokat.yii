<div id="order-form-main">
    <!-- number -->          
    <?=$f->field($form, 'number')->textInput(['value' => $order->number, 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
    
     <!-- date -->          
    <?=$f->field($form, 'date')->textInput(['value' => $order->date ? $order->date : date('d.m.y', time()) , 'maxlength'=>30, 'style' => 'width:120px'])->label('Дата выдачи:')?>
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <!-- mechanism -->          
    <?=$f->field($form, 'mechanism')->textInput(['value' => $order->mechanism])->label('Агрегат, механизм:')?>
    
    <!-- unit -->          
    <?=$f->field($form, 'unit')->textInput(['value' => $order->unit])->label('Узел:')?>

    <!-- type -->
    <?php 
        $form->type = $order ? $order->type : '4';
        $types = ['4' => 'Изготовление', '5' => 'Текущий ремонт', '6' => 'Капитальный ремонт'];
        echo $f->field($form, 'type')->dropDownList($types)->label('Статья затрат:');
    ?>
    <!-- desсription -->
    <?=$f->field($form, 'description')->textarea(['rows' => '1', 'value' => $order->description])->label('Описание работы:')?>
    
</div><!-- main-order -->