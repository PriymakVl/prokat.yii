<?php

use yii\base\View;
use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;

$this->registerCssFile('/css/orderact.css');
$this->registerJsFile('/js/orderact/select_standing_order.js');
$this->registerJsFile('/js/orderact/form_show_tab.js');
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
    <div class="top-menu margin-top-15">
        <a href="#" id="show-form-tab-main" class="top-menu-active-link">Акт</a>
        <a href="#" id="show-form-tab-items">Содержимое акта</a>
        <a href="#" id="show-form-tab-additional">Дополнительно</a>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-act']);?>
        
            <!-- form-tab-main -->
            <?=View::render('form_tab_main', ['f' => $f, 'act' => $act, 'form' => $form]);?>

            <!-- form-tab-items -->
            <?=View::render('form_tab_items', ['f' => $f, 'act' => $act, 'form' => $form, 'content' => $content]);?>

            <!-- form-tab-additional -->
            <?=View::render('form_tab_additional', ['f' => $f, 'act' => $act, 'form' => $form]);?>

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