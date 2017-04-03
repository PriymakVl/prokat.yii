<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
  
  <!-- header -->
    <div class="header search-box">
        <a href="/" class="link-home">Главная</a>
        <form action="/search" class="search-header" method="get">
            <input type="text" name="code" placeholder="Введите код (можно часть)" />
            <input type="submit" value="Найти" />
        </form>
    </div> 
    
    <div class="content-wrp"> 
    
        <?=$content?>
        
    </div>
    
    <div class="footer"></div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
