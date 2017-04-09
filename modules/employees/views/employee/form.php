<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\order\widgets\OrderFormTopMenuWidget;
use app\modules\order\widgets\OrderFormTabWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <?=$order ? 'Редакирование заказа' : 'Добавление заказа'?>
    </div>
    <!-- top menu -->
    <?=OrderFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order']); ?>
            
            <!-- main tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
            <!-- other tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
             <!-- work tab -->
            <?=OrderFormTabWidget::widget(['nameTab' => 'work', 'f' => $f, 'form' => $form, 'order' => $order])?>
            
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