<?php  

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\objects\widgets\ObjectMenuWidget;
use app\modules\objects\widgets\ObjectListMenuWidget;
use app\modules\objects\widgets\ObjectTopMenuWidget;

$this->registerCssFile('/css/specification.css');
    
?>
<div class="content">
    <!-- info -->
    <div class="department-list-info">
        Перечень участков стана 400/200
    </div>
    
    <!-- specification -->
    <table>
        <tr>
            <th width="40">№</th>
            <th width="510">Наименование</th>
            <th width="170">Код</th>
        </tr>
            <? foreach ($objects as $obj): ?>
                <tr>
                    <td align="center"><?=$obj->item?></td>
                    <td>
                        <a href="<?=Url::to(['/object/specification', 'obj_id' => $obj->id])?>"><?=$obj->name?></a>
                    </td>
                    <td class="text-center">
                        <a href="<?=Url::to(['/object/drawing', 'obj_id' => $obj->id])?>"><?=$obj->code?></a>
                    </td>
                </tr>
            <? endforeach; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?//=ObjectListMenuWidget::widget(['obj_id' => $parent->id])?>
</div> 