<?php

    use yii\helpers\Url;

//$this->registerJsFile('js/list/dwg_delete.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div  class="sidebar-menu">
    <h5>Эскиз</h5> 
    <ul id="dwg-managment-menu">
        <li>
            <a href="<?=Url::to(['/drawing/department/form'])?>">Добавить эскиз</a>
        </li>
        <li>
            <a href="<?=Url::to(['/drawing/department/delete', 'dwg_id' => $dwg_id])?>">Удалить эскиз</a>
        </li>
        <li>
            <a href="<?=Url::to(['/drawing/department/form', 'dwg_id' => $dwg_id])?>">Редактировать эскиз</a>
        </li>
        <li>
            <a href="<?=Url::to(['/order/content/add-draft', 'dwg_id' => $dwg_id])?>">Добавить в заказ</a>
        </li>
    </ul>    
</div>