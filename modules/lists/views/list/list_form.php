<?php

use yii\widgets\ActiveForm;
use app\widgets\MainMenuWidget;
use yii\helpers\Html;

$this->registerCssFile('/css/list.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($list): ?>
            Редакирование списка    
        <? else: ?>
            Создание нового списка
        <? endif; ?>
    </div>
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-list']); ?>
            <!-- list name -->          
            <?php 
                $listname = $list ? $list->name : ''; 
                echo $f->field($form, 'name')->textInput(['maxlenghth' => 30, 'placeholder' => 'максимальный размер 30 символов', 'value' => $listname])->label('Название списка:'); 
            ?>
            <!-- teg -->
            <?php
            $params = ['prompt' => 'Не выбран']; 
            if ($list) $form->type = $list->type;
            echo $f->field($form, 'type')->dropDownList($form->types, $params)->label('Тип списка:');
            ?>
            <!-- list description -->
            <?php
                if ($list) $form->description = $list->description;
                echo $f->field($form, 'description')->textarea(['rows' => '4'])->label('Описание списка:');
            ?>
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="location.href='http://' + location.host;" />
            <!-- hidden -->
            <input type="hidden" name="user_id" value="<? if(isset($user)) echo $user->id; ?>" />
            <?=$f->field($form, 'list_id')->hiddenInput(['value' => $list ? $list->id : false])->label(false) ?> 
        <? ActiveForm::end(); ?>
    </div>
</div>
<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>