<?php

use \yii\helpers\Url;
use \yii\web\JqueryAsset;

$this->registerJsFile('js/letter/letter_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- data menu -->
<div class="top-menu">
     <a href="#" class="top-menu-active-link" id="show-letter-data">Информация</a>
     <a href="#" id="show-letter-text">Содержание</a>
     <a href="#" id="show-letter-files">Файлы</a>
     <a href="javascript:history.back();">Назад</a>
</div>