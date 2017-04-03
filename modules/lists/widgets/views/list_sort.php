<?php

use \yii\web\JqueryAsset;

$this->registerJsFile('js/list/list_sort_menu.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- list sort menu-->
<div  class="sidebar-menu">
    <h5>Сортировка списков</h5>
    <div class="dropdown-menu-wrp">
        <label>Тип списка:</label>
        <select id="list-sort-menu">
            <option value="">Все</option>
            <? foreach ($types as $type): ?>
                <option value="<?=$type->alias?>" <? if ($type->alias == $params['type']) echo 'selected'; ?>><?=$type->name?></option>
            <? endforeach; ?>
        </select>
    </div>
</div>