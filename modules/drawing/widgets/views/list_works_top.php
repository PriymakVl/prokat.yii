<?php
    use \yii\web\JqueryAsset;
    $this->registerJsFile('js/drawing/dwg_list_sort.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div class="top-menu">
    <label>Конструкторское бюро:</label>
    <select id="department-dwg">
        <option value="">Все</option>
        <option <? if ($params['department'] == 'procat') echo 'selected'; ?>>Прокатное</option>
        <option <? if ($params['department'] == 'crane') echo 'selected'; ?>>Крановое</option>
    </select>
    <!--<label>Конструктор:</label>
    <select id="disainer-dwg">
        <option value="">Не выбран</option>
    </select>-->
</div>