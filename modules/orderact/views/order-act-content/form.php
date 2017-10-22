<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\orderact\widgets\OrderActContentFormTopMenuWidget;

$this->registerCssFile('/css/orderact.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($item): ?>
            Редактирование элемента акта   
        <? else: ?>
            Добавление элемента в акт
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?//=OrderActContentFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-act-content']);?>
        
        <!-- count -->          
        <?=$f->field($form, 'count')->textInput(['value' => $item ? $item->count : '', 'maxlength'=>4, 'style' => 'width:120px'])->label('Количество:')?>
        
        <!-- weight -->          
        <?=$f->field($form, 'weight')->textInput(['value' => $item ? $item->weight : '', 'style' => 'width:120px'])->label('Вес:')?>
        
        <!-- order act item id -->          
        <?=$f->field($form, 'item_id')->textInput(['value' => $item ? $item->item_id : '', 'style' => 'width:120px'])->label('ID элемента заказа:')?>
        
        <!-- order act id -->          
        <?=$f->field($form, 'act_id')->textInput(['value' => $item ? $item->act_id : '', 'style' => 'width:120px'])->label('ID заказа:')?>
       
        <!-- note -->
        <?=$f->field($form, 'note')->textarea(['rows' => '1', 'value' => $item->note])->label('Примечание:')?>
        
        <!-- button -->
        <input type="submit" value="Сохранить" />
        <input type="button" value="Отменить" onclick="javascript:history.back();" /> 
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>