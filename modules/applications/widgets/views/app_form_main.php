<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;
use app\modules\applications\models\Application;

//$this->registerJsFile('js/order/form_order_get_equipment.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="app-form-main">
    <!-- ens -->          
    <?=$f->field($form, 'ens')->textInput(['value' => $app ? $app->ens : '', 'maxlength'=>4, 'style' => 'width:120px'])->label('Номер ЕНС:')?>

    <!-- out number -->          
    <?=$f->field($form, 'out_num')->textInput(['value' => $app ? $app->out_num : '', 'maxlength'=>4, 'style' => 'width:120px'])->label('Исх. № заявки:')?>
    
    
    <!-- out date -->          
    <?=$f->field($form, 'out_date')->textInput(['value' => $app ? date('d.m.y', $app->out_date) : date('d.m.y'), 'maxlength'=>8, 'style' => 'width:120px'])->label('Дата выдачи:')?>
    
    <!-- title -->          
    <?=$f->field($form, 'title')->textInput(['value' => $app->title])->label('Название заявки:')?>
    
    <!-- type repair -->
    <?php 
        $form->period = $app ? $app->type : 'current';
        $departments = ['current' => 'Текущий', 'capital' => 'Капитальный', 'improvement' => 'Улучшение'];
        echo $f->field($form, 'type')->dropDownList($departments)->label('Вид ремонта:');
    ?>
    
    <!-- period -->
    <?php 
        $form->period = $app ? $app->period : 'year';
        $departments = ['year' => 'Годовая', 'month' => 'Месячная'];
        echo $f->field($form, 'period')->dropDownList($departments)->label('Срок выполнения:');
    ?>
    
    <!-- department -->
    <?php 
        $form->department = $app ? $app->department : 'equipment';
        $departments = ['equipment' => 'Отдел оборуд.', 'supply' => 'Отдел снабжения'];
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
        $states = [Application::STATE_APP_DRAFT => 'Черновик', 
                    Application::STATE_APP_CREATE => 'Создана',
                    Application::STATE_APP_ACTIVE => 'Здана',
                    ];
        echo $f->field($form, 'state')->dropDownList($states)->label('Состояние заявки:');
    ?>  
    
    <!-- category -->
    <div class="app-category-wrp field-applicationform-category">
        <label>Категория:</label>
        <select id="app-category" class="form-control" name="ApplicationForm[category]">
            <option value="">Невыбрана</option>
            <? foreach ($form->categories as $category): ?>
                <option value="<?=$category->alias?>" <? if ($params['category'] == $category->alias) echo 'selected'; ?>><?=$category->name?></option>               
            <? endforeach; ?>
        </select>
    </div> 
</div><!-- main-app -->