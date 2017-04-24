<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Home';
?>
<div class="site-index">
    <?php    foreach ($articles as $article):?>
        <h2> <?= $article->content; ?> </h2>
        <a href="<?= Url::toRoute(['site/view', 'id'=>$article->id]); ?>"> > Переглянути або написати коментарі до статті </a>  
    <?php    endforeach;?>
</div>
