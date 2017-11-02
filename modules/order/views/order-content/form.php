<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderFormTopMenuWidget;
use app\modules\order\widgets\OrderContentFormComponentWidget;
use app\modules\order\widgets\ContentFormTabWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($item): ?>
            Редакирование элемента заказа    
        <? else: ?>
            Добавление элемента заказа  
        <? endif; ?>
    </div>
    
    <!-- info -->
    <div class="info-box margin-top-15 margin-bottom-15">
        <span>Название заказа:</span>&laquo; <?=$order->name?> &raquo;<br />
        <span>Номер заказа:</span>&laquo; <?=$order->number?> &raquo;
    </div>
    
    <!-- top menu -->
    <?=OrderFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-item']);?>
        
            <!-- main tab -->
            <?=ContentFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'item' => $item])?>
            
            <!-- other tab -->
            <?=ContentFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'item' => $item])?>
            
            <!-- dimensions tab -->
            <?=ContentFormTabWidget::widget(['nameTab' => 'dimensions', 'f' => $f, 'form' => $form, 'item' => $item])?>
            
            <!-- hidden order id -->
            <?=$f->field($form, 'order_id')->hiddenInput(['value' => $order ? $order->id : false])->label(false) ?>
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