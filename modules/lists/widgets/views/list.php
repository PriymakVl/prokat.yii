<?php

use yii\helpers\Url;

if ($action == 'all') $this->registerJsFile('js/list/list_manager_all.js');
else $this->registerJsFile('/js/list/list_manager_index.js');
?>

<div  class="sidebar-menu">
    <h5>Список</h5> 
    <!-- list menu -->   
    <ul id="all-list-menu">
        <? if ($action == 'all'): ?>
            <li>
                <a href="#" id="list-active">Сделать активным</a>
            </li>
        <? else: ?>
        <li>
            <a href="<?=Url::to(['/list/set-active', 'list_id' => $list_id])?>">Сделать активным</a>
        </li>
        <li>
            <a href="<?=Url::to(['/lists'])?>">Все списки</a>
        </li>
        <? endif; ?>

        <!-- create list -->
        <li>
            <a href="<?=Url::to(['/list/form'])?>">Создать список</a>
        </li>

        <? if ($action == 'index' || $action == 'list-content'): ?>
            <li>
                <a href="<?=Url::to(['/list/form', 'list_id' => $list_id])?>">Редактировать список</a>
            </li>
        <? else: ?>
            <li>
                <a href="#" id="list-update">Редактировать список</a>
            </li>
        <? endif; ?>

        <li>
            <a href="#" id="list-delete">Удалить список</a>
        </li>
    </ul>
</div>

  