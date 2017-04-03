<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/order/form_content_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- data menu -->
<div class="top-menu top-menu-margin">
     <a href="#" id="show-content-form-main" class="top-menu-active-link">Главная</a>
     <a href="#" id="show-content-form-other">Дополнительно</a>
     <a href="#" id="show-content-form-object">Объект</a>
</div>