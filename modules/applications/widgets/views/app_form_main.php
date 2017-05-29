<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use app\modules\applications\models\Application;

//$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="app-form-main">
    <!-- ens -->          
    <?=$f->field($form, 'ens')->textInput(['value' => $order->number_ens, 'maxlength'=>4, 'style' => 'width:120px'])->label('Номер ЕНС:')?>

    <!-- out -->          
    <?=$f->field($form, 'out')->textInput(['value' => $order->number_out, 'maxlength'=>4, 'style' => 'width:120px'])->label('Исх. № заявки:')?>
    
    <!-- title -->          
    <?=$f->field($form, 'title')->textInput(['value' => $app->title])->label('Название заявки:')?>
    
    <!-- type repair -->
    <?php 
        $form->period = $app ? $app->type_repair : 'current';
        $departments = ['current' => 'Текущий', 'capital' => 'Капитальный'];
        echo $f->field($form, 'type_repair')->dropDownList($departments)->label('Вид ремонта:');
    ?>
    
    <!-- period -->
    <?php 
        $form->period = $app ? $app->period : 'year';
        $departments = ['year' => 'Годовая', 'mounth' => 'Месячная'];
        echo $f->field($form, 'period')->dropDownList($departments)->label('Срок выполнения:');
    ?>
    
    <!-- department -->
    <?php 
        $form->department = $app ? $app->department : 'ОО';
        $departments = ['ОО' => 'Отдел оборуд.', 'ОМТС' => 'Отдел снабжения'];
        echo $f->field($form, 'department')->dropDownList($departments)->label('Отдел:');
    ?>
    
    <!-- year -->   
    <?php 
        $year = date('Y');
        $form->year = $app ? $app->year : $year;
        $years = ['2014' => '2014', '2015' => '2015', '2016' => '2016', '2017' => '2017', '2018' => '2018'];
        echo $f->field($form, 'year')->dropDownList($years)->label('Год приобретения:');
    ?>       
    
    <!-- state -->
    <?php 
        $form->state = $app ? $app->state : Application::STATE_APP_DRAFT;
        $states = ['1' => 'Черновик', '2' => 'Сдана'];
        echo $f->field($form, 'state')->dropDownList($states)->label('Состояние заявки:');
    ?>   
</div><!-- main-app -->