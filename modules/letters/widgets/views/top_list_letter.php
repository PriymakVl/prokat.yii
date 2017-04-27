<?php
    use yii\web\JqueryAsset;
    
    $this->registerCssFile('/css/letter.css');
    $this->registerJsFile('js/letter/sort_letters.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div class="top-menu top-menu-margin">
    <!-- sort to -->
    <label>Кому:</label>
    <select id="letter-to">
        <option value="all">Все</option>
        <option value="4" <? if ($params['to'] == 4) echo 'selected'; ?>>Директор технический</option>
        <option value="3" <? if ($params['to'] == 3) echo 'selected'; ?>>Директор комерческий</option>
        <option value="2" <? if ($params['to'] == 2) echo 'selected'; ?>>Начальник ОО</option>
		<option value="1" <? if ($params['to'] == 1) echo 'selected'; ?>>Начальник ОМТС</option>
    </select>

    <!-- sort from -->
     <label>Исполнитель:</label>
    <select id="order-executor">
        <option value="all">Все</option>
        <option value="1" <? if ($params['customer'] == 1) echo 'selected'; ?>>Костырко В.Н.</option>
        <option value="2" <? if ($params['customer'] == 2) echo 'selected'; ?>>Саенко А.И.</option>
		<option value="4" <? if ($params['customer'] == 4) echo 'selected'; ?>>Волковский С.В.</option>
        <option value="7" <? if ($params['customer'] == 7) echo 'selected'; ?>>Станиславский О.В.</option>
        <option value="8" <? if ($params['customer'] == 8) echo 'selected'; ?>>Коваль А.П.</option>
        <option value="8" <? if ($params['customer'] == 9) echo 'selected'; ?>>Пасюк В.В.</option>
    </select>
    
    <!-- sort period -->
    <label>Период:</label>
    <select id="letter-period">
        <option value="4" <? if ($params['to'] == 4) echo 'selected'; ?>>За месяц</option>
        <option value="3" <? if ($params['to'] == 3) echo 'selected'; ?>>За квартал</option>
        <option value="2" <? if ($params['to'] == 2) echo 'selected'; ?>>За полгода</option>
		<option value="1" <? if ($params['to'] == 1) echo 'selected'; ?>>За год</option>
        <option value="all">Все</option>
    </select>
</div>
