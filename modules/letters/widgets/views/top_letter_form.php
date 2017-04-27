<?php

use \yii\web\JqueryAsset;
use \yii\helpers\Url;

$this->registerJsFile('js/letter/form_show_tab.js',  ['depends' => [JqueryAsset::className()]]);

?>

<!-- letter form top menu -->
<div class="top-menu top-menu-margin">
     <a href="#" id="show-letter-form-data" class="top-menu-active-link">Данные</a>
     <a href="#" id="show-letter-form-text">Текст</a>
</div>