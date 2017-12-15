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
    
    <!-- info -->
    <div class="info-box margin-top-15" >
        № акта: <strong><?=$act->number?></strong><br />
        № заказа: <strong><?=$act->order->number?></strong><br />
        Назв-ние заказа: <strong><?=$act->order->name?></strong>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-act-content']);?>
        
        <!-- name -->
        <?=$f->field($form, 'name')->textInput(['value' => $item ? $item->name : ''])->label('Наименование:')?>
        
        <div class="content-act-form-value-wrp">
            <!-- count -->          
            <?=$f->field($form, 'count')->textInput(['value' => $item ? $item->count : '', 'maxlength'=>4, 'style' => 'width:120px'])->label('Количество:')?>
        
            <!-- weight --> 
            <? 
                $weight = '';
                if ($item) $weight = $item->weight;
                if (!$weight && $item->item) $weight = $item->item->weight;
            ?>         
            <?=$f->field($form, 'weight')->textInput(['value' => $weight, 'style' => 'width:120px'])->label('Вес:')?>
            
            <!-- drawing -->
            <?=$f->field($form, 'drawing')->textInput(['value' => $item ? $item->drawing : '', 'style' => 'width:150px'])->label('Чертеж:')?>
            
            <!-- code -->
            <?=$f->field($form, 'code')->textInput(['value' => $item ? $item->code : '', 'style' => 'width:150px'])->label('Код детали:')?>
        </div>
        
        <div class="content-act-form-order-content-id-wrp">
            <!-- order act item id -->          
            <?=$f->field($form, 'item_id')->textInput(['value' => $item ? $item->item_id : '', 'style' => 'width:120px'])->label('ID элемента заказа:')?>
            
            <!-- order act id -->          
            <?=$f->field($form, 'act_id')->textInput(['value' => $item ? $item->act_id : '', 'style' => 'width:120px'])->label('ID заказа:')?>
        </div>
        
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