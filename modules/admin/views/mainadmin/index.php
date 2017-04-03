<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\components\other\MainMenuWidget;
use app\components\adminmenu\MainAdminMenuWidget;

$this->registerCssFile('/css/admin.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">
        Админ панель
    </div>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=MainAdminMenuWidget::widget()?>
    
</div>