<?php
    use \yii\web\JqueryAsset;
    $this->registerJsFile('js/drawing/dwg_list_sort.js',  ['depends' => [JqueryAsset::className()]]);
?>
<div class="top-menu margin-top-15">
    <label>Год:</label>
    <select id="year-create-dwg">
        <option value="">Все</option>
        <option <? if ($params['year'] == '2017') echo 'selected'; ?>>2017</option>
        <option <? if ($params['year'] == 2016) echo 'selected'; ?>>2016</option>
    </select>
    <!--
    <label>Служба:</label>
    <select id="service">
        <option value="">Все службы</option>
        <option value="mech">Механики</option>
        <option value="elect">Электрики</option>
    </select> -->
</div>