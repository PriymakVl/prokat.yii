<?php
    $this->registerJsFile('/js/drawing/dwg_list_sort.js');
?>
<div class="top-menu margin-top-15 ">
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