<?php
use yii\jui\DatePicker;
use app\modules\order\models\Order;

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
        
        <!-- type -->
        <?php 
            $form->type = $order ? $order->type : '4';
            $types = [Order::TYPE_MAKING => 'Изготовление (4)', Order::TYPE_MAINTENANCE => 'Тек. ремонт (5)',
            Order::TYPE_CAPITAL_REPAIR => 'Кап. ремонт (6)',  Order::TYPE_ENHANCEMENT=> 'Улучшение (1)'];
            echo $f->field($form, 'type')->dropDownList($types)->label('Статья затрат:');
        ?>

        <!-- inventory -->          
        <?=$f->field($form, 'inventory')->textInput(['value' => $order->inventory, 'style' => 'width:200px'])->label('Инвентарный номер:')?>

        <!-- service -->
        <?php
        $form->service = $order->service ? $order->service : $services->mech;
        echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
        ?>
    </div><!-- /top-box -->
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $order->name])->label('Название заказа:')?>
    
    <div class="equipment-unit-box">

        <!-- equipment blank-->          
        <?=$f->field($form, 'equipment_blank')->textInput(['value' => $order->equ_blank, 'style' => 'width:300px'])->label('Агрегат, механизм (бланк заказа):')?>
        
        <!-- unit blank -->          
        <?=$f->field($form, 'unit_blank')->textInput(['value' => $order->unit_blank, 'style' => 'width:380px'])->label('Узел (бланк заказа):')?>
    </div>
    
	<div class="issuer-customer-wrp">
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
    </div>

			
    <!-- desсription -->
    <?=$f->field($form, 'description')->textInput(['value' => $order->description ? $order->description : 'Изготовить детали'])->label('Описание работы:')?>
    
</div><!-- /main-order -->