<div id="app-form-other" style="display: none;">
    <!-- service -->
    <?php
    //$form->service = $order->service ? $order->service : $services->mech;
    //echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
    ?>
    
    <!-- created -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $issuers = ['5' => 'Приймак В.Н.', '6' => 'Немер А.Г.', '3' => 'Битюкова О.В', '0' => 'Другие'];
    $form->created = $app->created;
    echo $f->field($form, 'created')->dropDownList($issuers, $params)->label('Выдал:');
    ?>
    
    <!-- customer -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $customers = [ '1' => 'Костырко В.Н.', '2' => 'Саенко А.И.', '9' => 'Пасюк В.В.',  '4' => 'Волковский С.В.', 
			  '7' => 'Станиславский О.В', '10' => 'Лисецкий В.Р.',  '8' => 'Коваль А.П.', '0' => 'Другие'];
    $form->customer = $app->customer;
    echo $f->field($form, 'customer')->dropDownList($customers, $params)->label('Заказал:');
    ?>
    
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '4', 'value' => $app->note])->label('Примечание:')?>
</div><!-- other-app -->