<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\letters\widgets\LetterFormTopMenuWidget;
use app\modules\letters\widgets\LetterFormTabWidget;

$this->registerCssFile('/css/letter.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <?=$order ? 'Редакирование заказа' : 'Добавление заказа'?>
    </div>
    <!-- top menu -->
    <?=LetterFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order']); ?>
            
            <!-- text tab -->
            <?=LetterFormTabWidget::widget(['nameTab' => 'data', 'f' => $f, 'form' => $form, 'letter' => $letter])?>
            
            <!-- data tab -->
            <?=LetterFormTabWidget::widget(['nameTab' => 'text', 'f' => $f, 'form' => $form, 'letter' => $letter])?>
            
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