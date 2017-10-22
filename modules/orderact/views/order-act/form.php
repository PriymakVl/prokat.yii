<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\orderact\models\OrderAct;
use app\modules\orderact\widgets\OrderActFormTopMenuWidget;
use app\modules\orderact\widgets\OrderActFormTabWidget;

$this->registerCssFile('/css/orderact.css');

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
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-order-act']);?>
        
            <div id="order-act-form-tab-main">
    <div class="top-box">
        <!-- number -->          
        <?=$f->field($form, 'number')->textInput(['value' => $act ? $act->number : '', 'maxlength'=>4, 'style' => 'width:120px'])->label('Номер акта:')?>
        
    	<!-- department -->
        <?php 
            $form->department = $act ? $act->department : 'rem';
            $departments = ['rem' => 'РМЦ', 'ormo' => 'ОРМО', 'instr' => 'Инструмент.отделение', 'smk' => 'ЦМК'];
            $params = ['prompt' => 'Не выбран', 'style' => 'width:180px'];
            echo $f->field($form, 'department')->dropDownList($departments, $params)->label('Участок РМЦ:');
        ?>
        
    	<!-- state -->
        <div id="state-wrp">
            <label>Состояние:</label>
            <select id="state"  name="OrderActForm[state]" class="form-control" style="width: 180px;">
    			<option value="<?=OrderAct::STATE_PROCESSED?>" <? if ($act->state == OrderAct::STATE_PROCESSED) echo 'selected'; ?>>В оформлении</option>
    			<option value="<?=OrderAct::STATE_PASSED?>" <? if ($act->state == OrderAct::STATE_PASSED) echo 'selected'; ?>>Сдан</option>
    			<option value="<?=OrderAct::STATE_CANCELED?>" <? if ($act->state == OrderAct::STATE_CANCELED) echo 'selected'; ?>>Отменен</option>
            </select>
        </div>
    	
    </div><!-- /top-box -->
    
    <div class="act-form-date-wrp">
        <!-- date registration -->          
        <?=$f->field($form, 'date_creat')->textInput(['value' => $act->date_registr ? date('d.m.y', $act->date_registr) : date('d.m.y'), 'style' => 'width:120px'])->label('Зарегистр-ван:')?>
       
       <!-- month -->          
        <?php
            $params = ['prompt' => 'Не выбран', 'style' => 'width:180px'];
            $form->month = $act->month ? $act->month : date('m');
            echo $f->field($form, 'month')->dropDownList($form->months, $params)->label('Месяц:');
        ?>
        
        <!-- year -->          
        <?=$f->field($form, 'year')->textInput(['value' => $act->year ? $act->year : date('Y'), 'style' => 'width:180px'])->label('Год:')?>
    </div>
    
    <!-- data -->
    <div class="act-form-data-wrp">
        <!-- cost -->          
        <?=$f->field($form, 'cost')->textInput(['value' => $act->cost, 'style' => 'width:150px'])->label('Себестоимость, грн:')?>
    
        <!-- working hour -->          
        <?=$f->field($form, 'working_hour')->textInput(['value' => $act->working_hour, 'style' => 'width:180px'])->label('Нормо часы:')?>
    </div>
    	
    <!-- note -->
    <?=$f->field($form, 'note')->textarea(['rows' => '1', 'value' => $act->note])->label('Примечание:')?>
    
</div><!-- /order-act-form-tab-main -->
            
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