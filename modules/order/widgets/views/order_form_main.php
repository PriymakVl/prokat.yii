<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use app\modules\order\models\Order;

$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="order-form-main">
    <!-- number -->          
    <?=$f->field($form, 'number')->textInput(['value' => $order->number, 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
    
     <!-- date -->          
    <?=$f->field($form, 'date')->textInput(['value' => $order->date ? $order->date : date('d.m.y'), 'style' => 'width:120px'])->label('Дата выдачи:')?>
    <?
        //$form->date = $order ? $order->date : date('d.m.Y');
        //$test = Yii::$app->formatter->asDate('now', 'dd.MM.y');
        //debug($form->date);
        //$client_opt = ['language' => 'ru',];
        //echo $f->field($form,'date')->widget(DatePicker::className(),['clientOptions' => $client_opt]);
     ?>
	
	<!-- state select -->
    <div id="state-wrp">
        <label>Состояние:</label>
        <select id="state"  name="OrderForm[state]" class="form-control">
			<option value="<?=Order::STATE_ACTIVE?>" <? if ($order->state == Order::STATE_ACTIVE) echo 'selected'; ?>>Выдан</option>
			<option value="<?=Order::STATE_DRAFT?>" <? if ($order->state == Order::STATE_DRAFT) echo 'selected'; ?>>Черновик</option>
			<option value="<?=Order::STATE_CLOSED?>" <? if ($order->state == Order::STATE_CLOSED) echo 'selected'; ?>>Закрыт</option>
            <option value="<?=Order::STATE_NOT_ACCEPTED?>" <? if ($order->state == Order::STATE_NOT_ACCEPTED) echo 'selected'; ?>>Непринят</option>
        </select>
    </div>
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <!-- area -->
    <div id="area-wrp">
        <label>Участок:</label>
        <select id="orderform-area" name="OrderForm[area]" class="form-control">
            <option value="" selected="selected">Не выбран</option>
            <? foreach ($form->areaAll as $area): ?>
                <option value="<?=$area->alias?>" <? if ($area->alias == $order->area) echo 'selected'; ?> area_id="<?=$area->id?>"><?=$area->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    
    <!-- mechanism select -->
    <div id="area-mechanism-wrp">
        <label>Агрегат, механизм:</label>
        <select id="area-mechanism" disabled="disabled" class="form-control">
            <option>Не выбран</option>
        </select>
    </div>
    
    <!-- unit select -->
    <div id="mechanism-unit-wrp">
        <label>Узел:</label>
        <select id="mechanism-unit" disabled="disabled" class="form-control">
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
    
    <!-- issuer -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $issuers = ['5' => 'Приймак В.Н.', '6' => 'Немер А.Г.', '3' => 'Битюкова О.В', '0' => 'Другие'];
    $form->issuer = $order->issuer;
    echo $f->field($form, 'issuer')->dropDownList($issuers, $params)->label('Выдал:');
    ?>
    
    <!-- customer -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $customers = [ '1' => 'Костырко В.Н.', '2' => 'Саенко А.И.', '9' => 'Пасюк В.В.',  '4' => 'Волковский С.В.', 
			  '7' => 'Станиславский О.В', '10' => 'Лисецкий В.Р.',  '8' => 'Коваль А.П.', '0' => 'Другие'];
    $form->customer = $order->customer;
    echo $f->field($form, 'customer')->dropDownList($customers, $params)->label('Заказал:');
    ?>
    
    <!-- desсription -->
    <?=$f->field($form, 'description')->textarea(['rows' => '1', 'value' => $order->description ? $order->description : 'Изготовить детали'])->label('Описание работы:')?>
    
</div><!-- main-order -->