<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/order/form_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- data menu -->
<div class="top-menu top-menu-margin">
     <a href="#" id="show-order-form-main" class="top-menu-active-link">Главная</a>
     <a href="#" id="show-order-form-other">Дополнительно</a>
     <a href="#" id="show-order-form-work">Характер работ</a>
</div>