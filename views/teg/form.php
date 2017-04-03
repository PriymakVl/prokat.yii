<?php
    use yii\widgets\ActiveForm;
    use app\components\MainMenuWidget;
    use yii\helpers\Html;
    
    $this->registerCssFile('/css/list.css');
?>
<div class="content">
    <!-- title -->
    <div class="title-box">
            Редакирование типа списка    
    </div>
    
    <!-- form -->
    <div class="form-wrp">
        <? $f = ActiveForm::begin(['id' => 'form-type-list']); ?>
        
            <!-- name -->          
            <?php 
                $name = $type ? $type->name : ''; 
                echo $f->field($form, 'name')->textInput(['value' => $name])->label('Название типа:'); 
            ?>
            
            <!-- value -->          
            <?php 
                $value = $type ? $type->value : ''; 
                echo $f->field($form, 'value')->textInput(['value' => $value])->label('Значение типа:'); 
            ?>
            
            <!-- button -->
            <input type="submit" value="Сохранить" />
            <input type="button" value="Отменить" onclick="location.href='http://' + location.host;" />
            
            <!-- hidden -->
            <?=$f->field($form, 'id')->hiddenInput(['value' => $type ? $type->id : false])->label(false) ?> 
            
        <? ActiveForm::end(); ?>
        
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">

    <?=MainMenuWidget::widget()?>
          
</div>