<?php

use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
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
    <?=OrderMenuWidget::widget(['type' => 'form-content'])?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-item']);?>
        
            <!-- main tab -->
            <?=View::render('main', ['f' => $f, 'item' => $item, 'form' => $form]);?>
            
            <!-- other tab -->
             <?=View::render('other', ['f' => $f, 'item' => $item, 'form' => $form]);?>
            
            <!-- dimensions tab -->
            <?=View::render('dimensions', ['f' => $f, 'item' => $item, 'form' => $form]);?>
            
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