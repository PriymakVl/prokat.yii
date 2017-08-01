<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('/js/application/form_show_tab.js');

?>

<!-- data menu -->
<div class="top-menu top-menu-margin">
     <a href="#" onclick="return false;" id="show-app-form-main" class="top-menu-active-link">Главная</a>
     <a href="#" onclick="return false;" id="show-app-form-other">Дополнительно</a>
     <a href="#" onclick="return false;" id="show-app-form-doc">Связанные документы</a>
</div>