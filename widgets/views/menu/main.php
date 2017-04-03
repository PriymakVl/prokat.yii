<div class="sidebar-menu" id="main-menu">
    <h5>Главное меню</h5>
    <ul>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['/'])?>">Главная страница</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['list/active'])?>">Текущий список</a>
        </li>
        <li>Мои списки</li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['lists'])?>">Все списки</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['admin'])?>">Admin panel</a>
        </li>
        <li>
            <a href="<?=Yii::$app->urlManager->createUrl(['object-danieli-update'])?>">Доб об из файлов</a>
        </li>
    </ul>
</div>