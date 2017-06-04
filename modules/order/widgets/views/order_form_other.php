<div id="order-form-other" style="display: none;">
    <!-- service -->
    <?php
    $form->service = $order->service ? $order->service : $services->mech;
    echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
    ?>
    
    <!-- weight -->          
    <?=$f->field($form, 'weight')->textInput(['value' => $order->weight])->label('Вес заказа:')?>
    
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '4', 'value' => $order->note])->label('Примечание:')?>
</div><!-- other-order -->