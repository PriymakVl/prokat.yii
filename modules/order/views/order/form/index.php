<?php

use yii\base\View;
use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderMenuWidget;
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
    
    <!-- top menu -->
    <?=OrderMenuWidget::widget(['type' => 'form-order'])?>
    
    <!-- inventory menu -->
    <?=View::render('inventory_menu');?>

    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-item']);?>
        
            <!-- main tab -->
            <?=View::render('main', ['f' => $f, 'order' => $order, 'form' => $form]);?>
            
            <!-- other tab -->
            <?=View::render('other', ['f' => $f, 'order' => $order, 'form' => $form]);?>
            
            <!-- work tab -->
            <?=View::render('work', ['f' => $f, 'order' => $order, 'form' => $form]);?>

            <!-- filters tab -->
            <?=View::render('filters', ['f' => $f, 'order' => $order, 'form' => $form]);?>

            <!-- inventory tab -->
            <?=View::render('inventory', ['f' => $f, 'order' => $order, 'form' => $form]);?>
            <?//=OrderFormTabWidget::widget(['nameTab' => 'inventory', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
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