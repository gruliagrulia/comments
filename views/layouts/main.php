<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Home',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
?>
 
    <ul class="nav navbar-nav navbar-right">
        <?php if(Yii::$app->user->isGuest):?>
        <li><a href="<?= \yii\helpers\Url::toRoute(['auth/login'])?>">Login</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute(['auth/signup'])?>">Register</a></li>
        <?php else: ?>
            <?= Html::beginForm(['/auth/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->name . ')',
                ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
            )
            . Html::endForm() ?>
        <?php endif;?>
    </ul>

    <?php
    NavBar::end();
    ?>


    <div class="container">      
        <?= $content ?>
    </div>
</div>

    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
