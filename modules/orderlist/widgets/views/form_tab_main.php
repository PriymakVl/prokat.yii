<?php
use yii\jui\DatePicker;
use app\modules\orderlist\models\OrderList;

//$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
//$this->registerJsFile('js/order/form_set_customer_issuer.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="order-list-form-main">
    <div class="top-box">
        <!-- out number -->          
        <?=$f->field($form, 'out_num')->textInput(['value' => $list->out_num, 'maxlength'=>3, 'style' => 'width:120px'])->label('Исх.№:')?>
        
         <!-- date -->          
        <?=$f->field($form, 'out_date')->textInput(['value' => $list->out_date ? $order->out_date : date('d.m.y'), 'style' => 'width:120px'])->label('Дата регистрации:')?>
        <?
            //$form->date = $order ? $order->date : date('d.m.Y');
            //$test = Yii::$app->formatter->asDate('now', 'dd.MM.y');
            //debug($form->date);
            //$client_opt = ['language' => 'ru',];
            //echo $f->field($form,'date')->widget(DatePicker::className(),['clientOptions' => $client_opt]);
         ?>
    	
    	<!-- type -->
        <?php 
            $form->type = $list ? $list->type : OrderList::TYPE_LETTER;
            $types = [OrderList::TYPE_LETTER => 'Письмо', OrderList::TYPE_MONTH => 'План на месяц', 
                OrderList::TYPE_CAPITAL => 'Капитальный ремонт', OrderList::TYPE_OTHER => 'Разное'];
            echo $f->field($form, 'type')->dropDownList($types)->label('Тип списка:');
        ?>
    </div><!-- /top-box -->
    
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $list->name])->label('Название списка:')?>
			
    <!-- desсription -->
    <?=$f->field($form, 'note')->textarea(['rows' => '1', 'value' => $list->note ? $list->note : ''])->label('Примечание:')?>
    
</div><!-- /order-list-form-main -->