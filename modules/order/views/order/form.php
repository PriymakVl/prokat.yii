<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderFormTopMenuWidget;
use app\modules\order\widgets\OrderContentFormComponentWidget;
use app\modules\order\widgets\OrderFormTabWidget;
use app\modules\order\widgets\OrderFormInventoryMenuWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($order): ?>
            Редакирование заказа    
        <? else: ?>
            Добавление заказа  
        <? endif; ?>
    </div>
    
    <!-- info message -->
    <? $messages = ['danger', 'success', 'warning']; ?>
    <? foreach ($messages as $message): ?>
        <?php if (Yii::$app->session->hasFlash($message)): ?>
          <div class="alert alert-<?=$message?> margin-top-15">
              <?= Yii::$app->session->getFlash($message) ?>
          </div>
        <?php endif; ?>
    <? endforeach; ?>
    
    <!-- top menu -->
    <?=OrderFormTopMenuWidget::widget()?>
    
    <!-- inventory menu -->
    <?=OrderFormInventoryMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-item']);?>
        
            <!-- main tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
            <!-- other tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
            <!-- work tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'work', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
            <!-- inventory tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'inventory', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
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