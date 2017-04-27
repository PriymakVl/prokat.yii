<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;
use app\modules\letters\widgets\LetterMenuWidget;
use app\modules\letters\widgets\LetterTopMenuWidget;
//use app\modules\letters\widgets\LetterFileMenuWidget;

$this->registerCssFile('/css/letter.css');
?>
<div class="content">
    <!-- top nenu -->
    <?=LetterTopMenuWidget::widget()?>
    
    <!-- letter data -->
    <div id="letter-data">
        <table>
            <tr>
                <th width="180">Наименование</th>
                <th width="545">Значение</th>
            </tr>
            <!-- number -->
            <tr>
                <td class="text-center">Номер письма</td>
                <td <? if($letter->number == 'черновик') echo 'style="color: red;"'; ?>>
                    <?=$letter->number?>  
                </td>
            </tr>
            <!-- name -->
            <tr>
                <td class="text-center">Тема</td>
                <td>
                    <?=$letter->subject?>
                </td>
            </tr>
            <!-- whom -->
            <tr>
                <td class="text-center">Кому адресовано</td>
                <td>
                    <?=$letter->whom?>
                </td>
            </tr>
            <!-- copy -->
            <? if ($letter->copy): ?>
                <? foreach ($letter->copy as $item): ?>
                    <tr>
                        <td class="text-center">Копия</td>
                        <td><?=$item?></td>
                    </tr>
                <? endforeach; ?>
            <? endif; ?>
            <!-- from -->
            <tr>
            <? if ($letter->from): ?>
                    <? foreach ($letter->from as $item): ?>
                        <td class="text-center">От кого</td>
                        <td><?=$item?></td>
                    <? endforeach; ?>
            <? else: ?>
                <td class="text-center">От кого</td>
                <td style="color:red;">Не указано</td>
            <? endif; ?>
            </tr>
            <!-- executor -->
            <tr>
                <td class="text-center">Исполнитель</td>
                <td><?=$letter->executor?></td>
            </tr>
            <!-- issuer -->
            <tr>
                <td class="text-center">Кто написал</td>
                <td><?=$letter->issuer?></td>
            </tr>
            <!-- date create -->
            <tr>
                <td class="text-center">Дата создания</td>
                <td><?=$letter->date?></td>
            </tr>
            <!-- note -->
            <? if ($letter->note): ?>
                <tr>
                    <td class="text-center">Примечание</td>
                    <td><?=$letter->note?></td>
                </tr>
            <? endif; ?>
        </table>
    </div><!-- letter data -->
    
    <div id="letter-text" style="display:none;">
        <?=$letter->text?>
    </div><!-- letter text -->
    
    <div id="letter-file" style="display:none;">
        какие то файлы
    </div><!-- letter files -->
</div><!-- content -->

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
    
    <?=LetterMenuWidget::widget(['letter_id' => $letter->id])?>
    
    <?//=LetterFileMenuWidget::widget(['letter_id' => $letter->id])?>
    
</div>