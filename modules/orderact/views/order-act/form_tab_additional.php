<?
use app\modules\orderact\models\OrderAct;
use app\modules\order\models\Order;

?>
<div id="order-act-form-tab-additional" style="display: none">

    <div class="act-form-order-wrp">
        <!-- number of order -->
        <?=$f->field($form, 'order_num')->textInput(['value' => $act->order ? $act->order->number : $act->order_num, 'style' => 'width:120px'])->label('Номер заказа:')?>

        <!-- id of order -->
        <?=$f->field($form, 'order_id')->textInput(['value' => $act->order->id, 'style' => 'width:100px'])->label('ID заказа:')?>

        <!-- standing orders -->
        <div class="form-group standing-orders-wrp" >
            <label class="control-label">Постоянные заказы:</label>
            <select id="standing-orders" class="form-control">
                <option value="" order_num="">Не выбран</option>
                <option value="409" order_num="041">041 РМЦ - изготовление</option>
                <option value="" order_num="038">038 ОРМО - изготовление</option>
            </select>
        </div>
    </div>

    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '1', 'value' => $act->note])->label('Примечание:')?>

</div><!-- /order-act-form-tab-main -->