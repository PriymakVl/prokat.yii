<?php
use yii\jui\DatePicker;
use yii\web\JqueryAsset;

$this->registerJsFile('js/letter/form_select_whom.js',  ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile('js/letter/form_delete_input_copy.js',  ['depends' => [JqueryAsset::className()]]);
?>

<div id="letter-form-data">
    <!-- number Out-->          
    <?//=$f->field($form, 'numberOut')->textInput(['value' => $letter->numberOut, 'maxlength'=>3, 'style' => 'width:120px'])->label('Исх №:')?>
    
     <!-- date -->          
    <?=$f->field($form, 'date')->textInput(['value' => $letter->date ? $letter->date : date('d.m.y', time()), 'maxlength'=>30, 'style' => 'width:120px'])->label('Дата:')?>
    <?//= $f->field($form,'date')->widget(DatePicker::className(),['clientOptions' => []]) ?>
    
    <!-- subject -->          
    <?=$f->field($form, 'subject')->textInput(['value' => $letter->subject])->label('Тема письма:')?>
    
    <!-- whom -->
    <div id="letter-whom-wrp">
        <label>Кому:</label>
        <select id="letter-whom-select">
            <option>Не выбран</option>
            <option value="Волошин А.А.">Директор технический</option>
            <option value="Кравченко А.А.">Директор комерческий</option>
            <option value="Несвет А.А.">Директор по производсту</option>
            <option value="Кривицкая Е.В.">Начальник ОМТС</option>
        </select>
        <label class="toggle-whom-copy">Кому:</label>
        <input type="radio" name="whom" value="whom" checked="checked"/>
        <label class="toggle-whom-copy">Копия:</label>
        <input type="radio" name="whom" value="copy"/>
        <a href="#" onclick="return false;" id="delete-input-copy" style="display:none">Удалить копии</a>
        <br /><br />
        <label>кому должность:</label><input type="text" class="whom-position" id="letterform-whom_position" value="<?=$letter->whomPosition?>" name="LetterForm[whom_position" />
        <label>кому имя:</label><input type="text" class="whom-name" id="letterform-whom_name" value="<?=$letter->whomName?>" name="LetterForm[whom_name" /><br /><br />
        <?//=$f->field($form, 'whom_position')->textInput(['value' => $letter->whomPosition])->label('Должность получателя:')?>
        <?//=$f->field($form, 'whom_name')->textInput(['value' => $letter->whomName])->label('Имя получателя:')?>
        <!-- copy -->
    </div>
    
   <!-- executor -->
    <?php
    $params = ['prompt' => 'Не выбран'];
    $customers = [ '1' => 'Костырко В.Н.', '2' => 'Саенко А.И.', '9' => 'Пасюк В.В.',  '4' => 'Волковский С.В.', 
			  '7' => 'Станиславский О.В', '10' => 'Лисецкий В.Р.',  '8' => 'Коваль А.П.', '0' => 'Другие'];
    $form->executor = $letter->executor;
    echo $f->field($form, 'executor')->dropDownList($customers, $params)->label('Исполнитель:');
    ?>
    
    
</div><!-- letter data -->