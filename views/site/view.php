<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Comments';
?>
<?php if(!empty($article)):?>
    <div class="site-index">
        <h2> <?= $article->content; ?> </h2>
    </div>

    <?php if(!Yii::$app->user->isGuest):?>
    <div class="comment-form">
        <?php $form = ActiveForm::begin([
            'action' => ['site/create', 'id'=>$article->id],
            'options' => ['class'=>'form-horizontal contact-form', 'role'=>'form']])?>
                <?= $form->field($commentForm, 'comment')->textarea(['class'=>'form-control','placeholder'=>'WriteMessage'])->label(false)?>
        <button type="submit" class="btn send-btn">Відправити коментарій</button>
        <?php ActiveForm::end();?>
    </div>
    <?php else :?> 
    <div>
        <h3>Зареєструйтеся та авторизуйтеся для того, щоб писати коментарі</h3>
    </div>    
    <?php endif;?>

    <?php if( !empty($comments) ):?>
        <?php foreach ( $comments as $comment ):?>        
<div style="margin-top: 30px;">
                <font color="blue"><?= $comment->user->name;?></font>
          
                <i>
                     <?= $comment->date;?>
                </i>           

                <p><?= Html::encode($comment->text) ?></p>
                <?php if ($comment->user->id == Yii::$app->user->id):?>
                    <p>       
                        <?= Html::a('Update', ['update', 'id' => $comment->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $comment->id, 'article_id' => $article->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this comment?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </p>
                <?php endif;?>
</div> 
        <?php endforeach;?>
    <?php endif; ?>
<?php endif; ?>
