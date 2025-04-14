<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */


$this->title = 'Comment — DevClone';
?>

                                   
<?php if (!Yii::$app->user->isGuest): ?>
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($newComment, 'content')->textarea(['rows' => 3]) ?>
      <?= Html::submitButton('Post Comment', ['class' => 'btn btn-primary']) ?>
      <?php ActiveForm::end(); ?>
  <?php else: ?>
      <p><a href="<?= Url::to(['site/login']) ?>">Log in</a> to comment.</p>
  <?php endif; ?>
