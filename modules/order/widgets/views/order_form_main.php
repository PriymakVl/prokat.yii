<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use app\modules\order\models\Order;

$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/order/form_set_customer_issuer.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="order-form-main">
    <div class="top-box">
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
    	
    	<!-- type -->
        <?php 
            $form->type = $order ? $order->type : '4';
            $types = ['4' => 'Изготовление (4)', '5' => 'Услуга (5)', '6' => 'Кап. ремонт (6)', '1' => 'Улучшение (1)'];
            echo $f->field($form, 'type')->dropDownList($types)->label('Статья затрат:');
        ?>
    </div><!-- /top-box -->
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <div class="middle-box clear">
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
    </div><!-- /middle box -->
    
    
    <!-- mechanism -->          
    <?=$f->field($form, 'mechanism')->textInput(['value' => $order->mechanism])->label('Агрегат, механизм:')?>
    
    <!-- unit -->          
    <?=$f->field($form, 'unit')->textInput(['value' => $order->unit])->label('Узел:')?>
	
    <!-- issuer -->
    <div class="issuer-box">
        <?=$f->field($form, 'issuer')->textInput(['value' => $order->issuer])->label('Выдал:')?>
    	<div class="mech-issuer-wrp">
    		<label>Выдал:</label>
    		<select id="mech-issuer" class="form-control">
    			<option value="">Не выбран</option>
    			<option value="Приймак В.Н." <? if ($order->issuer == 'Приймак В.Н.') echo "selected"; ?>>Приймак В.Н.</option>
    			<option value="Немер А.Г." <? if ($order->issuer == 'Немер А.Г.') echo "selected"; ?>>Немер А.Г.</option>
    			<option value="Битюкова О.В." <? if ($order->issuer == 'Битюкова О.В.') echo "selected"; ?>>Битюкова О.В.</option>
    		</select>
    	</div>
    </div><!-- /issuer box -->
        
        <!-- customer -->
        <div class="customer-box">
            <?=$f->field($form, 'customer')->textInput(['value' => $order->customer])->label('Заказал:')?>
        	<div class="mech-customer-wrp">
        		<label>Заказал:</label>
        		<select id="mech-customer" class="form-control">
        			<option value="">Не выбран</option>
        			<option value="Костырко В.Н." <? if ($order->customer == 'Костырко В.Н.') echo "selected"; ?>>Костырко В.Н.</option>
        			<option value="Саенко А.И." <? if ($order->customer == 'Саенко А.И.') echo "selected"; ?>>Саенко А.И.</option>
        			<option value="Пасюк В.В." <? if ($order->customer == 'Пасюк В.В.') echo "selected"; ?>>Пасюк В.В.</option>
        			<option value="Волковский С.В." <? if ($order->customer == 'Волковский С.В.') echo "selected"; ?>>Волковский С.В.</option>
        			<option value="Станиславский О.В." <? if ($order->customer == 'Станиславский О.В.') echo "selected"; ?>>Станиславский О.В</option>
        			<option value="Лисецкий В.Р." <? if ($order->customer == 'Лисецкий В.Р.') echo "selected"; ?>>Лисецкий В.Р.</option>
        			<option value="Коваль А.П." <? if ($order->customer == 'Коваль А.П.') echo "selected"; ?>>Коваль А.П.</option>
        		</select>
        	</div>
        </div><!-- /customer box -->
			
    <!-- desсription -->
    <?=$f->field($form, 'description')->textarea(['rows' => '1', 'value' => $order->description ? $order->description : 'Изготовить детали'])->label('Описание работы:')?>
    
</div><!-- /main-order -->