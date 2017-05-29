<?php
use yii\web\JqueryAsset;

$this->registerJsFile('js/application/change_search_app.js', ['depends' => JqueryAsset::className()]); 
?>
<div class="header search-box search-app">
    <a href="/" class="link-home">Главная</a>
     <label>Исх.№</label>
    <input type="radio" name="search" value="out" checked="checked" holder="Введите исходящий номер заявки"/>
    <label>ЕНС</label>
    <input type="radio" name="search" value="ens" holder="Введите номер заявки в ЕНС"/>
    
    <form action="/search/application" class="search-header" method="get">
        <input type="text" name="out" placeholder="Введите исходящий номер заявки" autofocus />
        <input type="submit" value="Найти" />
    </form>
</div> 