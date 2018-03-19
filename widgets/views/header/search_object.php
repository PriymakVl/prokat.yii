<?php

$this->registerJsFile('/js/total/change_search.js');
?>
<div class="header search-box">

    <a href="/" class="link-home">Главная</a>
    <label>Название</label>
    <input type="radio" name="search" value="name" action="/search/object/name" holder="Введите название детали"/>
    <label class="label-header-search">Код</label>
    <input type="radio" name="search" action="/search/object/code" value="code" holder="Введите код детали" checked/>

    <form action="/search/object/code" class="search-header" method="get">

        <input type="text" name="code" placeholder="Введите код детали" autofocus />

        <input type="submit" value="Найти" />

    </form>

</div> 