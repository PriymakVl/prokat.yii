<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

?>

<div class="content">
    <!-- title -->
    <div class="title-box">Добавление объектов из файла Excel (Danieli)</div>
    
    <!-- info -->
    <div class="info-box margin-top-15">
        <span>Название родителя:</span>&laquo; <?=$parent->name?> &raquo;
        <? if ($parent->code): ?>
            <br />
            <span>Код родителя:</span>&laquo; <?=$parent->code?> &raquo;
        <? endif; ?>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-daieli-file']); ?>
            <!-- file xml -->
            <?= $f->field($form, 'file')->fileInput()->label('Файл Excel:') ?>
            <!-- button -->
            <input type="submit" value="Добавить объекты" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>