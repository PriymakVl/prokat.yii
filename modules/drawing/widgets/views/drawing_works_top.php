<?php

use \yii\web\JqueryAsset;

?>

<!-- data menu -->
<div class="top-menu">
    <a href="/drawing/works?dwg_id=<?=$dwg_id?>" <? if ($page == 'data') echo 'class="top-menu-active-link"'; ?>>Информация</a>
    <? if ($child): ?>
        <a href="/drawing/works/specification?dwg_id=<?=$dwg_id?>" <? if ($page == 'specification') echo 'class="top-menu-active-link"'; ?>>Спецификация</a>
    <? endif; ?>
    <a href="/drawing/works/files?dwg_id=<?=$dwg_id?>" <? if ($page == 'files') echo 'class="top-menu-active-link"'; ?>>Файлы</a>
    <a href="/drawing/works/list">Каталог</a>
    <a href="javascript:history.back();">Назад</a>
</div>