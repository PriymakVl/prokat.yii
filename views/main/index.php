<?php  

use \yii\web\JqueryAsset;
use app\widgets\MainMenuWidget; 
use app\widgets\SectionMenuWidget;
use app\modules\drawing\widgets\DrawingMainMenuWidget;
use yii\helpers\Url;

$this->registerCssFile('/css/main.css');
$this->registerJsFile('js/main/list_department_accordion.js',  ['depends' => [JqueryAsset::className()]]);

?>

<div class="content">
    <!-- info -->
    <div class="department-list-info">
        Перечень участков стана 400/200
    </div>

    <!-- department list -->
    <ul class="department-list">
        <? foreach ($objects as $obj): ?>
            <li class="department-list-item" obj_id="<?=$obj->id?>" >
                <a href="<?=Url::to(['/object', 'obj_id' => $obj->id])?>"  target="_blank">***</a>
                <a href="#" onclick="sublist(this);" li_content="" title="<?=$obj->id?>"><?=$obj->name?></a>
            </li>
        <? endforeach; ?>
    </ul>
</div>

<!-- menu -->
<div class="sidebar-wrp">

    <?=MainMenuWidget::widget()?>

    <?=DrawingMainMenuWidget::widget()?>

    <?=SectionMenuWidget::widget()?>

</div>
