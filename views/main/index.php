<?php

use yii\helpers\Url;
use app\widgets\MainMenuWidget;

$this->registerCssFile('/css/main.css');

?>
<div class="content">
    <!-- info -->
    <div class="main-title">
        Перечень участков стана 400/200
    </div>

    <table class="margin-top-15">
        <tr>
            <th width="40">№</th>
            <th width="180">Наименование</th>
            <th width="500">Краткое содержание</th>
        </tr>
            <!-- Склад заготовок -->
            <tr>
                <td align="center">1</td>
                <td>
                    <a href="/object/specification?obj_id=18599">Склад заготовок</a>
                </td>
                <td>
                    <a href="/object/specification?obj_id=">ПУ 31</a><span> / </span>
                    <a href="/object/specification?obj_id=">загрузочная решетка</a><span> / ...</span>
                </td>
            </tr>
            <!-- Печное оборудование -->
            <tr>
                <td align="center">2</td>
                <td>
                    <a href="/object/specification?obj_id=18600">Печное оборудование</a>
                </td>
                <td>
                    <a href="/object/specification?obj_id=18857">загруз. машина</a><span> / </span>
                    <a href="/object/specification?obj_id=">печь</a><span> / </span>
                    <a href="/object/specification?obj_id=14863">kick off</a><span> / </span>
                </td>
            </tr>
            <!-- Выход с печи -->
            <tr>
                <td align="center">3</td>
                <td>
                    <a href="/object/specification?obj_id=18665">Оборуд. перед станом</a>
                </td>
                <td>
                    <a href="/object/specification?obj_id=18734">окалиноломатель</a><span> / </span>
                    <a href="/object/specification?obj_id=18733">рольганг</a><span> / </span>
                    <a href="/object/specification?obj_id=18736">трайбаппарат</a><span> / </span>
                </td>
            </tr>
        <!-- Стан -->
        <tr>
            <td align="center">4</td>
            <td>
                <a href="/object/specification?obj_id=18601">Стан</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=2030">черновой</a><span> / </span>
                <a href="/object/specification?obj_id=2031">промежуточный</a><span> / </span>
                <a href="/object/specification?obj_id=2032">чистовой</a><span> / </span>
                <a href="/object/specification?obj_id=18609">лупера</a><span> / ...</span>
            </td>
        </tr>
        <!-- Сортовая линия -->
        <tr>
            <td align="center">5</td>
            <td>
                <a href="/object/specification?obj_id=18602">Сортовая линия</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=">прием. рольганг</a><span> / </span>
                <a href="/object/specification?obj_id=18671">холодильник</a><span> / </span>
                <a href="/object/specification?obj_id=">РПМ</a><span> / </span>
                <a href="/object/specification?obj_id=">НХР</a><span> / </span>
            </td>
        </tr>
        <!-- Участок отделки -->
        <tr>
            <td align="center">6</td>
            <td>
                <a href="/object/specification?obj_id=">Участок отделки</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=">пакетировщик</a><span> / </span>
                <a href="/object/specification?obj_id=">зона удаления</a><span> / </span>
            </td>
        </tr>
        <!-- Слиттинг -->
        <tr>
            <td align="center">7</td>
            <td>
                <a href="/object/specification?obj_id=18622">Слиттинг</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=18817">BGV4</a><span> / </span>
                <a href="/object/specification?obj_id=18873">ножницы</a><span> / </span>
                <a href="/object/specification?obj_id=18893">трайбаппараты</a><span> / </span>
                <a href="/object/specification?obj_id=6835">сдвоен. канал</a><span> / </span>
            </td>
        </tr>
        <!-- Линия катанки -->
        <tr>
            <td align="center">8</td>
            <td>
                <a href="/object/specification?obj_id=18624">Линия катанки</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=">лупер №9</a><span> / </span>
                <a href="/object/specification?obj_id=">BGV10</a><span> / </span>
                <a href="/object/specification?obj_id=">TRH 320</a><span> / </span>
                <a href="/object/specification?obj_id=">виткообразователь</a><span> / </span>
                <a href="/object/specification?obj_id=">рольганг охлаж.</a><span> / </span>
            </td>
        </tr>
        <!-- Бунтовая линия -->
        <tr>
            <td align="center">9</td>
            <td>
                <a href="/object/specification?obj_id=">Бунтовая линия</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=">виткосборник</a><span> / </span>
                <a href="/object/specification?obj_id=">паллеты</a><span> / </span>
                <a href="/object/specification?obj_id=">компактор</a><span> / </span>
                <a href="/object/specification?obj_id=">сбрасыватель</a><span> / ...</span>
            </td>
        </tr>
        <!-- Разное -->
        <tr>
            <td align="center">10</td>
            <td>
                <a href="/object/specification?obj_id=">Разное</a>
            </td>
            <td>
                <a href="/object/specification?obj_id=29403">ГПМ</a><span> / </span>
                <a href="/object/specification?obj_id=18913">dump</a><span> / </span>
                <a href="/object/specification?obj_id=18675">Пустые</a><span> / </span>
                <a href="/object/specification?obj_id=27765">Эскизы</a><span> / </span>
            </td>
        </tr>
    </table>
</div>

<!-- menu -->
<div class="sidebar-wrp">
    <?=MainMenuWidget::widget()?>
</div>