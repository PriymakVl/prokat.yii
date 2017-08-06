<?php
use yii\helpers\Html;
//use app\assets\BaseAsset;
//use app\assets\AppAsset;
use app\widgets\HeaderWidget;
//use yii\bootstrap\Alert;

$this->title = '';

//BaseAsset::register($this);
\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- header -->
        <?=HeaderWidget::widget()?>
        
        <div class="content-wrp"> 
            
            <?=$content?>
        
        </div>
        
        <div class="footer"></div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
