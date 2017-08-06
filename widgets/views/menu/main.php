<div class="sidebar-menu" id="main-menu">
    <h5>Главное меню</h5>
    <ul>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['/'])?>">Главная страница</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['list/active'])?>">Текущий список</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['drawing/department/list'])?>">Эскизы цеха</a>
        </li>
        <li><a href="/order/list">Заказы</a></li>
        <li><a href="/application/list">Заявки</a></li>
        <li><a href="/standard/list">Стандарты</a></li>
    </ul>
</div>