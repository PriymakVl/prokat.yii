<?php

use yii\web\JqueryAsset;
use app\modules\order\widgets\OrderContentFormComponentWidget;

//$this->registerJsFile('js/order/form_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div id="content-form-main">
    <!-- drawing -->          
    <?=$f->field($form, 'drawing')->textInput(['value' => $item->drawing, 'maxlength'=>50, 'style' => 'width:265px'])->label('Чертеж:')?>
    
    <!-- number sheet -->          
    <?=$f->field($form, 'sheet')->textInput(['value' => $item->sheet ? $item->sheet : 1, 'maxlength'=>5, 'style' => 'width:100px'])->label('Лист:')?>
    
    <!-- item -->          
    <?=$f->field($form, 'item')->textInput(['value' => $item->item ? $item->item : 0, 'maxlength'=>5, 'style' => 'width:100px'])->label('Позиция:')?>
    
    <!-- name -->          
    <?=$f->field($form, 'name')->textInput(['value' => $item->name])->label('Название:')?>
    
    <!-- count -->          
    <?=$f->field($form, 'count')->textInput(['value' => $item->count ? $item->count : 1, 'maxlength'=>5, 'style' => 'width:100px'])->label('Количество:')?>
    
    <!-- material -->          
    <?=$f->field($form, 'material')->textInput(['value' => $item->material, 'id' => 'item-material', 'maxlength'=>100, 'style' => 'width:300px'])->label('Материал:')?>
    
    <!-- select material widget -->
    <?=OrderContentFormComponentWidget::widget(['template' => 'material'])?>
    
    <!-- weight -->          
    <?=$f->field($form, 'weight')->textInput(['value' => $item->weight ? $item->weight : '0,00', 'maxlength'=>10, 'style' => 'width:100px'])->label('Вес:(кг)')?>
</div><!-- main-content -->