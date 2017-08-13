<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\orderact\widgets\OrderActFormTopMenuWidget;
use app\modules\orderact\widgets\OrderActFormTabWidget;

$this->registerCssFile('/css/order.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($act): ?>
            Редактирование акта   
        <? else: ?>
            Регистрация акта
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?=OrderActFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-act']);?>
        
            <!-- main tab -->
            <?=OrderActFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'act' => $act])?>
            
            <!-- other tab -->
            <?//=OrderFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'list' => $list])?>
            
            <!-- hidden list id -->
            <?=$f->field($form, 'act_id')->hiddenInput(['value' => $act ? $act->id : false])->label(false) ?>
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