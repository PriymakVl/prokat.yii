<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;

$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="order-form-main">
    <!-- number -->          
    <?=$f->field($form, 'number')->textInput(['value' => $order->number, 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
    
     <!-- date -->          
    <?=$f->field($form, 'date')->textInput(['value' => $order->date ? $order->date : date('d.m.y', time()), 'maxlength'=>30, 'style' => 'width:120px'])->label('Дата выдачи:')?>
    <?//= $f->field($form,'date')->widget(DatePicker::className(),['clientOptions' => []]) ?>
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <!-- area -->
    <?php 
        //$params = ['prompt' => 'Не выбран', 'style' => 'width:200px',];
        //echo $f->field($form, 'area')->dropDownList($form->areaAll, $params)->label('Участок:');
    ?>
    <div id="area-wrp">
        <label>Участок:</label>
        <select id="orderform-area" name="OrderForm[area]">
            <option value="" selected="selected">Не выбран</option>
            <? foreach ($form->areaAll as $area): ?>
                <option value="<?=$area->alias?>" <? if ($area->alias == $order->area) echo 'selected'; ?> area_id="<?=$area->id?>"><?=$area->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    
    <!-- mechanism select -->
    <div id="area-mechanism-wrp">
        <label>Механизм:</label>
        <select id="area-mechanism" disabled="disabled">
            <option>Не выбран</option>
        </select>
    </div>
    
    <!-- unit select -->
    <div id="mechanism-unit-wrp">
        <label>Узел:</label>
        <select id="mechanism-unit" disabled="disabled">
            <option>Не выбран</option>
        </select>
    </div>
    
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