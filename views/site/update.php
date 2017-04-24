<?php

use yii\widgets\ActiveForm;

$this->title = 'Update';

if($model->user->id == Yii::$app->user->id):?>
    <div class="comment-form">
        <?php $form = ActiveForm::begin();?>
                <?= $form->field($model, 'text')->textarea(['class'=>'form-control'])->label(false)?>
        <button type="submit" class="btn send-btn">Редагувати коментарій</button>
        <?php ActiveForm::end();?>
    </div>
<?php endif;?>