<!-- top menu -->
<div class="top-menu">
    <a href="/drawing/works?dwg_id=<?=$dwg_id?>" <? if ($page == 'data') echo 'class="top-menu-active-link"'; ?>>Информация</a>
    <a href="/drawing/works/specification?dwg_id=<?=$dwg_id?>" <? if ($page == 'specification') echo 'class="top-menu-active-link"'; ?>>Спецификация</a>
    <a href="/drawing/works/list">Каталог</a>
    <a href="javascript:history.back();">Назад</a>
</div>