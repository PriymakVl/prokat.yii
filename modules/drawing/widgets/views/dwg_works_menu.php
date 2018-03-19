<?php

    use yii\helpers\Url;

//$this->registerJsFile('js/list/dwg_delete.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div  class="sidebar-menu">
    <h5>Чертеж ПКО</h5> 
    <ul id="dwg-managment-menu">
        <li>
            <a href="<?=Url::to(['/drawing/works/form'])?>">Добавить чертеж</a>
        </li>
        <li>
            <a href="<?=Url::to(['/drawing/works/delete', 'dwg_id' => $dwg_id])?>">Удалить чертеж</a>
        </li>
        <li>
            <a href="<?=Url::to(['/drawing/works/form', 'dwg_id' => $dwg_id])?>">Редактировать чертеж</a>
        </li>
    </ul>    
</div>