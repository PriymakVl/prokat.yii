<?php
use app\modules\order\models\Order;
?>

<div id="order-form-other" style="display: none;">

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

    <!-- kind -->
    <?php
    $form->kind = $order ? $order->kind : Order::KIND_CURRENT;
    $kinds = [Order::KIND_CURRENT => 'Разовый', Order::KIND_PERMANENT => 'Постоянный', Order::KIND_ANNUAL => 'Годовой'];
    $params = ['style' => 'width: 200px'];
    echo $f->field($form, 'kind')->dropDownList($kinds, $params)->label('Вид заказа:');
    ?>
    
    <!-- weight -->          
    <?=$f->field($form, 'weight')->textInput(['value' => $order->weight])->label('Вес заказа:')?>
    
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '4', 'value' => $order->note])->label('Примечание:')?>
</div><!-- other-order -->