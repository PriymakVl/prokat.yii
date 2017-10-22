<?php

use app\modules\order\widgets\OrderContentFormComponentWidget;

$this->registerJsFile('/js/order/content_form_set_name.js');
?>

<div id="content-form-main">
    <!-- number drawing -->          
    <?=$f->field($form, 'drawing')->textInput(['value' => $item->drawing, 'maxlength'=>50, 'style' => 'width:265px'])->label('Номер чертежа:')?>
   
    <!-- variant -->          
    <?=$f->field($form, 'variant')->textInput(['value' => $item->variant, 'maxlength'=>5, 'style' => 'width:100px'])->label('Вариант:')?>
    
    <!-- number sheet -->          
    <?=$f->field($form, 'sheet')->textInput(['value' => $item->sheet ? $item->sheet : 1, 'maxlength'=>5, 'style' => 'width:100px'])->label('Лист:')?>
    
    <!-- variant -->          
    <?=$f->field($form, 'variant')->textInput(['value' => $item->variant, 'maxlength'=>5, 'style' => 'width:100px'])->label('Вариант:')?>
    
    <!-- item -->          
    <?=$f->field($form, 'item')->textInput(['value' => $item->item ? $item->item : 0, 'maxlength'=>5, 'style' => 'width:100px'])->label('Позиция:')?>
    
    <!-- name --> 
    <div id="unit-name-wrp">
        <?=$f->field($form, 'name')->textInput(['value' => $item->name, 'style' => 'width:400px'])->label('Название:')?>
        
        <div id="unit-name-select-wrp">
            <label>Выбрать название:</label>
    		<select id="names" class="form-control" style="width:220px;">
    			<option value="">Не выбрано</option>
                <? foreach ($form->detailNames as $name): ?>
                    <option value="<?=$name?>"><?=$name?></option>
                <? endforeach; ?>
    		</select>
        </div>
    </div>         
    
    
    <!-- delivery -->
    <?
        if (!empty($item->delivery)) $form->delivery = true;
        echo $f->field($form, 'delivery')->checkbox(['value' => 1, 'label' => 'Доставляет заказчик:']);
    ?>
    
    <!-- count -->          
    <?=$f->field($form, 'count')->textInput(['value' => $item->count ? $item->count : 1, 'maxlength'=>5, 'style' => 'width:100px'])->label('Количество:')?>
    
    <!-- material --> 
        <div id="material-form-wrp">
            <?=$f->field($form, 'material')->textInput(['value' => $item->material, 'maxlength'=>100, 'style' => 'width:300px'])->label('Материал:')?>
        
        <!-- select material -->
        <?=OrderContentFormComponentWidget::widget(['template' => 'material'])?>
    </div>  
    
    <!-- additional material --> 
        <div id="material-add-form-wrp">
            <?=$f->field($form, 'material_add')->textInput(['value' => $item->material_add, 'maxlength'=>100, 'style' => 'width:300px'])->label('Дополнительный материал:')?>
        
        <!-- select additional material -->
        <?=OrderContentFormComponentWidget::widget(['template' => 'material'])?>
    </div>        
    
    <!-- weight -->          
    <?=$f->field($form, 'weight')->textInput(['value' => $item->weight, 'maxlength'=>10, 'style' => 'width:100px'])->label('Вес:(кг)')?>
</div><!-- main-content -->