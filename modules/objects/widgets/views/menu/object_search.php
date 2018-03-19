<?php

use \yii\web\JqueryAsset;

$this->registerCssFile('/css/search.css');    
?>

<!-- search object menu -->
<div  class="sidebar-menu">
    <h5>Поиск объекта</h5>   
    <form action="/search/object/code" class="search-sidebar" method="get">

        <input type="text" name="code" autofocus />

        <input type="submit" value="Найти" />

    </form>  
</div>