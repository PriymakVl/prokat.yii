<?php
use yii\jui\DatePicker;
?>

<div id="order-form-main">
    <!-- number -->          
    <?=$f->field($form, 'number')->textInput(['value' => $order->number, 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
    
     <!-- date -->          
    <?=$f->field($form, 'date')->textInput(['value' => $order->date ? $order->date : date('d.m.y', time()), 'maxlength'=>30, 'style' => 'width:120px'])->label('Дата выдачи:')?>
    <?//= $f->field($form,'date')->widget(DatePicker::className(),['clientOptions' => []]) ?>
    
    <!-- tags -->
    <?php 
        $params = ['prompt' => 'Не выбран', 'style' => 'width:200px'];
        echo $f->field($form, 'tag')->dropDownList($form->tags, $params)->label('Участок:');
    ?>
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <!-- mechanism -->          
    <?=$f->field($form, 'mechanism')->textInput(['value' => $order->mechanism, 'style' => 'width:520px'])->label('Агрегат, механизм:')?>
    
    <!-- unit -->          
    <?=$f->field($form, 'unit')->textInput(['value' => $order->unit])->label('Узел:')?>

    <!-- type -->
    <?php 
        $form->type = $order ? $order->type : '4';
        $types = ['4' => 'Изготовление (4)', '5' => 'Услуга (5)', '6' => 'Кап. ремонт (6)', '1' => 'Улучшение (1)'];
        echo $f->field($form, 'type')->dropDownList($types)->label('Статья затрат:');
    ?>
    
    <!-- desсription -->
    <?=$f->field($form, 'description')->textarea(['rows' => '1', 'value' => $order->description ? $order->description : 'Изготовить детали'])->label('Описание работы:')?>
    
</div><!-- main-order -->