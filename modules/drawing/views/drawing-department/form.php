<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\widgets\MainMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use app\modules\drawing\widgets\DrawingListMenuWidget;

$this->registerCssFile('/css/drawign.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        <? if ($dwg): ?>
            Редакирование цехового чертежа/эскиза    
        <? else: ?>
            Добавление цехового чертежа/эскиза  
        <? endif; ?>
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-department-dwg', 'options' => ['enctype'=>'multipart/form-data']]); ?>
            <!-- name -->          
            <?php 
                echo $f->field($form, 'name')->textInput(['value' => $dwg ? $dwg->name : ''])->label('Название чертежа:'); 
            ?>
			
			<!-- alias -->
			<?php 
                echo $f->field($form, 'alias')->textInput(['value' => $dwg ? $dwg->alias : ''])->label('Короткое название чертежа:'); 
            ?>
			
            <!-- type -->
            <?php 
                $form->type = $dwg ? $dwg->type : 'file';
                $types = ['file' => 'Файл', 'folder' => 'Папка'];
                echo $f->field($form, 'type')->dropDownList($types)->label('Тип:');
            ?>
            <!-- parent_id -->
            <?= $f->field($form, 'parent_id')->textInput(['value' => $dwg->parent_id ? $dwg->parent_id : 0])->label('ID родителя:') ?>
            <!-- flle -->
            <div id="dwg-file-input-wrp" <? if ($dwg->type == 'folder') echo 'style="display:none;"'; ?>> 
                <?= $f->field($form, 'file')->fileInput()->label('Файл чертежа:') ?>
            </div>
            <!-- service -->
            <?php
            $form->service = $dwg->service ? $dwg->service : '';
            echo $f->field($form, 'service')->dropDownList($form->services)->label('Служба цеха:');
            ?>
            <!-- desinger -->
            <?php
            //$params = ['prompt' => 'Не выбран'];
//            $designers = ['Приймак' => 'Приймал В.Н.', 'Немер' => 'Немер А.Г.'];
//            if ($dwg) $form->designer = $dwg->designer;
//            echo $f->field($form, 'designer')->dropDownList($designers, $params)->label('Конструктор:');
            ?>
            <!-- note -->
            <?php
                if ($dwg) $form->note = $dwg->note;
                echo $f->field($form, 'note')->textarea(['rows' => '4'])->label('Примечание:');
            ?>
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="javascript:history.back();" />
            <!-- hidden -->
            <?=$f->field($form, 'dwg_id')->hiddenInput(['value' => $dwg ? $dwg->id : false])->label(false) ?> 
        <? ActiveForm::end(); ?>
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=DrawingMainMenuWidget::widget()?>
	<?=DrawingListMenuWidget::widget()?>
</div>