<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\orderlist\widgets\OrderListFormTopMenuWidget;
use app\modules\orderlist\widgets\OrderListFormTabWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($list): ?>
            Редакирование списка заказов   
        <? else: ?>
            Добавление списка заказов
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?=OrderListFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-list-item']);?>
        
            <!-- main tab -->
            <?=OrderListFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'list' => $list])?>
            
            <!-- other tab -->
            <?//=OrderFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'list' => $list])?>
            
            <!-- hidden list id -->
            <?=$f->field($form, 'list_id')->hiddenInput(['value' => $list ? $list->id : false])->label(false) ?>
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