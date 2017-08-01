<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
u//se app\modules\applications\widgets\AppFormTopMenuWidget;
use app\modules\applications\widgets\AppContentMenuWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($item): ?>
            Редакирование элемента заявки   
        <? else: ?>
            Добавление элемента заявки  
        <? endif; ?>
    </div>
    
    <!-- top menu -->
    <?//=OrderFormTopMenuWidget::widget()?>
    
    <!-- info -->
    <div class="info-box">
        <span>Заявка:</span>&laquo; <?=$app->title?> &raquo;<br />
        <span>Номер заявки:</span>&laquo; <?=$app->out_num?> &raquo;
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-app-item']);?>
        
            <!-- product id -->          
            <?= $f->field($form, 'product_id')->textInput(['value' => $item ? $item->product_id : '', 'style' => 'width:250px'])->label('ID продукта:')?>
			
			<!-- count need -->          
            <?= $f->field($form, 'need')->textInput(['value' => $item ? $item->need : '', 'style' => 'width:250px'])->label('Необходимое количество:')?>
			
			<!-- rest -->          
            <?= $f->field($form, 'rest')->textInput(['value' => $item ? $item->rest : '', 'style' => 'width:250px'])->label('Остаток:')?>
			
			<!-- price -->          
            <?= $f->field($form, 'price')->textInput(['value' => $item ? $item->price : '', 'style' => 'width:250px'])->label('Цена:')?>
            
			<!-- currency -->
            <?php
                $params = ['prompt' => 'Не выбран']; 
                if ($item) $form->currency = $item->currency;
                echo $f->field($form, 'currency')->dropDownList($form->currency, $params)->label('Валюта:');
            ?>
            
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