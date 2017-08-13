<?php
use yii\jui\DatePicker;
use app\modules\orderact\models\OrderAct;

//$this->registerJsFile('js/order/form_order_get_equipment.js');
?>

<div id="order-act-form-tab-main">
    <div class="top-box">
        <!-- number -->          
        <?=$f->field($form, 'number')->textInput(['value' => $act ? $act->number : '', 'maxlength'=>3, 'style' => 'width:120px'])->label('Номер заказа:')?>
        
         <!-- date registration -->          
        <?=$f->field($form, 'date_creat')->textInput(['value' => $act->date_creat, 'style' => 'width:120px'])->label('Дата выдачи:')?>
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
    			<option value="<?=OrderAct::STATE_ACTIVE?>" <? if ($order->state == OrderAct::STATE_ACTIVE) echo 'selected'; ?>>В оформлении</option>
    			<option value="<?=OrderAct::STATE_DELETED?>" <? if ($order->state == OrderAct::STATE_DELETED) echo 'selected'; ?>>Удален</option>
    			<option value="<?=OrderAct::STATE_PASSED?>" <? if ($order->state == OrderAct::STATE_PASSED) echo 'selected'; ?>>Здан</option>
            </select>
        </div>
    	
    	<!-- department -->
        <?php 
            $form->department = $act ? $act->department : 'rem';
            $departments = ['rem' => 'РМЦ', 'ormo' => 'ОРМО', 'inst' => 'Инструмент.отделение', 'smk' => 'ЦМК'];
            echo $f->field($form, 'department')->dropDownList($departments)->label('Цех(участок):');
        ?>
    </div><!-- /top-box -->
    
    
    <!-- cost -->          
    <?=$f->field($form, 'cost')->textInput(['value' => $act->act])->label('Себестоимость:')?>
    
    <!-- time -->          
    <?=$f->field($form, 'time')->textInput(['value' => $act->time])->label('Нормо часы:')?>
			
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '1', 'value' => $act->note])->label('Примечание:')?>
    
</div><!-- /order-act-form-tab-main -->