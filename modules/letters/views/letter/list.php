<?php

use \yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use Yii\helpers\Url;
use yii\widgets\LinkPager;
use app\widgets\MainMenuWidget;
use app\modules\letters\widgets\LetterMenuWidget;
use app\modules\letters\widgets\LetterListMenuWidget;
use app\modules\letters\widgets\LetterTopListMenuWidget;

$this->registerCssFile('/css/letter.css');

?>
<div class="content">
    <!-- title -->
    <div class="title-box">Перечень писем сортопрокатного стана</div>
    
    <!-- top nenu -->
    <?=LetterTopListMenuWidget::widget(['params' => $params])?>
    
    <!-- list of letters -->
    <table id="list-letter">
        <tr>
            <th width="30">
                <input type="checkbox" disabled="disabled" />
            </th>
            <th width="90">Исх. №</th>
            <th width="470">Наименование</th>
            <th width="130">Кому</th>
        </tr>
        <? if ($list): ?>
            <? foreach ($list as $letter): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="letter" letter_id="<?=$letter->id?>" />
                    </td>
                    <td class="text-center">
                       <?=$letter->number?>
                    </td>
                    <td>
                        <a href="<?=Url::to(['/letter', 'letter_id' =>$letter->id])?>"><?=$letter->subject?></a>
                    </td>
                    <td>
                        <?=$letter->whomPosition?>
                    </td>
                </tr>
            <? endforeach; ?>
        <? else: ?>
            <tr>
                <td colspan="4" class="not-content">Писем нет</td>
            </tr>
        <? endif; ?>
    </table>
    <!-- pagination -->
    <div class="pagination-wrp">
        <?=LinkPager::widget(['pagination' => $pages])?>    
    </div><!-- class pagination-wrp -->
</div><!-- class content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    <?=LetterListMenuWidget::widget()?>
    <?=LetterMenuWidget::widget()?>
</div>