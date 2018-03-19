<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use app\modules\order\models\Order;
use app\modules\order\logic\OrderLogic;

$this->registerJsFile('/js/order/form_order_get_equipment.js');
$this->registerJsFile('/js/order/form_set_customer_issuer.js');
?>

<div id="order-form-main">
    <div class="top-box">
        <!-- number -->          
        <?=$f->field($form, 'number')->textInput(['value' => $order ? $order->number : $form->newNumber, 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
        
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
            $types = [Order::TYPE_MAKING => 'Изготовление (4)', Order::TYPE_MAINTENANCE => 'Тек. ремонт (5)',
            Order::TYPE_CAPITAL_REPAIR => 'Кап. ремонт (6)',  Order::TYPE_ENHANCEMENT=> 'Улучшение (1)'];
            echo $f->field($form, 'type')->dropDownList($types)->label('Статья затрат:');
        ?>
        
        <!-- kind -->
        <?php 
            $form->kind = $order ? $order->kind : Order::KIND_CURRENT;
            $kinds = [Order::KIND_CURRENT => 'Разовый', Order::KIND_PERMANENT => 'Постоянный', Order::KIND_ANNUAL => 'Годовой'];
            $params = ['style' => 'width: 200px'];
            echo $f->field($form, 'kind')->dropDownList($kinds, $params)->label('Вид заказа:');
        ?>
    	
        <!-- inventory -->          
        <?=$f->field($form, 'inventory')->textInput(['value' => $order->inventory, 'style' => 'width:200px'])->label('Инвентарный номер:')?>
    
    </div><!-- /top-box -->
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <div class="middle-box clear">
    
        <!-- sections -->
        <div id="sections-wrp">
            <label>Участки:</label>
            <select id="orderform-sections" name="OrderForm[section]" class="form-control">
                <option value="" selected="selected">Не выбран</option>
                <? foreach ($form->sections as $section): ?>
                    <option value="<?=$section->id?>" <? if ($section->id == $order->section) echo 'selected'; ?> alias="<?=$section->alias?>"><?=$section->name?></option>
                <? endforeach; ?>
            </select>
        </div>
        
        <!-- equipments select -->
        <div id="section-equipments-wrp">
            <label>Агрегаты, механизмы:</label>
            <select id="section-equipments" <? if (!$form->equipments) echo 'disabled="disabled"'; ?> class="form-control">
                <option name_equ="">Не выбран</option>
                <? if ($form->equipments): ?>
                    <? foreach ($form->equipments as $equipment): ?>
                        <option value="<?=$equipment['alias']?>" <? if ($equipment['id'] == $order->equipment) echo 'selected'; ?> inventory="<?=$equpment['inventory']?>" name_equ="<?=$equpment['name']?>" equipment_id="<?=$equipment['id']?>"><?=$equipment['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>
        
        <!-- unit select -->
        <div id="equipment-units-wrp">
            <label>Узлы:</label>
            <select id="equipment-units" <? if (!$form->units) echo 'disabled="disabled"'; ?> class="form-control">
                <option name_unit="">Не выбран</option>
                <? if ($form->units): ?>
                    <? foreach ($form->units as $unit): ?>
                        <option value="<?=$unit['alias']?>" <? if ($unit['id'] == $order->unit) echo 'selected'; ?> name_unit="<?=$unit['name']?>" unit_id="<?=$unit['id']?>"><?=$unit['name']?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
        </div>
        
    </div><!-- /middle box -->
    
    <div class="equipment-unit-box">
        <!-- equipment -->          
        <?=$f->field($form, 'equipment')->textInput(['value' => $order->equipmentName, 'style' => 'width:200px'])->label('Агрегат (сортировка):')?>
        
        <!-- equipment blank-->          
        <?=$f->field($form, 'equipment_blank')->textInput(['value' => $order->equ_blank, 'style' => 'width:465px'])->label('Агрегат, механизм (бланк заказа):')?>
    
        <!-- unit -->          
        <?=$f->field($form, 'unit')->textInput(['value' => $order->unitName, 'style' => 'width:200px'])->label('Узел (сортировка):')?>
        
        <!-- unit blank -->          
        <?=$f->field($form, 'unit_blank')->textInput(['value' => $order->unit_blank, 'style' => 'width:465px'])->label('Узел (бланк заказа):')?>
    </div>
    
	
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