<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

?>

<!-- data menu -->
<div class="top-menu">
     <a href="<?=Url::to(['/standard', 'std_id' => $std_id])?>" <? if ($page == 'info') echo 'class="top-menu-active-link"'; ?>>Информация</a>
     <a href="<?=Url::to(['/standard/files', 'std_id' => $std_id])?>" <? if ($page == 'files') echo 'class="top-menu-active-link"'; ?>>Файлы</a>
     <a href="<?=Url::to(['/standard/list'])?>">Каталог</a>
     <a href="javascript:history.back();">Назад</a>
</div>