<?php
    use yii\widgets\ActiveForm;
    use app\components\MainMenuWidget;
    use app\components\TypeListMenuWidget;
    use yii\helpers\Html;
    
    $this->registerCssFile('/css/list.css');
?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень типов для списков</div>
    
    <!-- list type all -->
    <table id="list-type-all">
        <tr>
            <th width="30">
                <input type="radio" disabled="disabled" />
            </th>
            <th width="345">Наименование</th>
            <th width="345">Значеие</th>
        </tr>
        <? if ($types): ?>
            <? foreach ($types as $type): ?>
                <tr>
                    <td>
                        <input type="radio" name="type" value="<?=$type->id?>" />
                    </td>
                    <td class="text-center">
                       <?=$type->name?>
                    </td>
                    <td class="text-center">
                       <?=$type->value?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="3" class="not-content">Типов нет</td>
            </tr>
        <? endif; ?>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">

    <?=MainMenuWidget::widget()?>
    
    <?=TypeListMenuWidget::widget(['flag' => true])?>
          
</div>