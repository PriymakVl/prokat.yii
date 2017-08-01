<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\applications\widgets\AppFormTopMenuWidget;
use app\modules\applications\widgets\AppFormTabWidget;

$this->registerCssFile('/css/application.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <?=$app ? 'Редакирование заявки' : 'Создание заявки'?>
    </div>
    <!-- top menu -->
    <?=AppFormTopMenuWidget::widget()?>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-app']); ?>
            
            <!-- main tab -->
            <?=AppFormTabWidget::widget(['nameTab' => 'main', 'f' => $f, 'form' => $form, 'app' => $app])?>
            
            <!-- other tab -->
            <?=AppFormTabWidget::widget(['nameTab' => 'other', 'f' => $f, 'form' => $form, 'app' => $app])?>
            
             <!-- link document tab -->
            <?=AppFormTabWidget::widget(['nameTab' => 'document', 'f' => $f, 'form' => $form, 'app' => $app])?>
            
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