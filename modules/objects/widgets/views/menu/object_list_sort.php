<?php

use \yii\web\JqueryAsset;

$this->registerJsFile('js/object/object_list_sort.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- object list sort menu-->
<div  class="sidebar-menu">
    <h5>Сортировка</h5>
    <div class="dropdown-menu-wrp">
        <label>Наименование</label>
        <select id="obj-list-sort">
            <option value="">Все</option>
            <option value="standard" <? if ($sort == 'standard') echo 'selected'; ?>>Стандарты</option>
            <option value="unit" <? if ($sort == 'unit') echo 'selected'; ?>>Узлы и детали</option>
            <option value="highlight" <? if ($sort == 'highlight') echo 'selected'; ?>>Выделены</option>
            <option value="order" <? if ($sort == 'order') echo 'selected'; ?>>Заказаны</option>
            <option value="app" <? if ($sort == 'app') echo 'selected'; ?>>Заявлены</option>
        </select>
    </div>
</div>