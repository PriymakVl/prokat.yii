<div id="order-form-other" style="display: none;">
    <!-- service -->
    <?php
    $form->service = $order->service ? $order->service : $services->mech;
    echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
    ?>
    <!-- issuer -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $issuers = ['Приймак' => 'Приймак В.Н.', 'Немер' => 'Немер А.Г.'];
    $form->issuer = $order->issuer;
    echo $f->field($form, 'issuer')->dropDownList($issuers, $params)->label('Выдал:');
    ?>
    
    <!-- customer -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $customers = ['Костырко' => 'Костырко В.Н.', 'Саенко' => 'Саенко А.И.'];
    $form->customer = $order->customer;
    echo $f->field($form, 'customer')->dropDownList($customers, $params)->label('Заказал:');
    ?>
    
    <!-- weight -->          
    <?=$f->field($form, 'weight')->textInput(['value' => $order->weight])->label('Вес заказа:')?>
    
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '4', 'value' => $order->note])->label('Примечание:')?>
</div><!-- other-order -->