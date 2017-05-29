<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/application/form_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- data menu -->
<div class="top-menu top-menu-margin">
     <a href="#" id="show-app-form-main" class="top-menu-active-link">Главная</a>
     <a href="#" id="show-app-form-other">Дополнительно</a>
     <a href="#" id="show-app-form-document">Связанные документы</a>
</div>