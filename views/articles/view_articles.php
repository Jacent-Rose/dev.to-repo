<?php

/** @var yii\web\View $this */
/** @var app\models\Articles[] $model */ // $model is an array of Articles

use app\models\Articles;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Posts'; // Adjust title as needed
?>


<div class="row mt-4">
    <div class="col-md-8">
        <h1>My Posts</h1>

        <?php if (!empty($model)): ?>
            <?php usort($model, function ($a, $b) {
                return $b->created_at - $a->created_at;
            }); ?>

            <?php foreach ($model as $article): ?>
                <div class="card p-4 mb-3">
                    <div class="d-flex align-items-center mb-3">
                        <?= Html::a(
                            Html::img($article->user->profile_picture ?? '/web/images/default.png', [
                                'class' => 'rounded-circle me-2',
                                'alt' => 'User',
                                'style' => 'width: 40px; height: 40px;',
                            ]),
                            ['users/view-users', 'id' => $article->user->id]
                        ) ?>

                        <div>
                            <strong><?= Html::encode($article->user->username ?? 'Unknown User') ?></strong><br>
                            <small class="text-muted">Posted on <?= Yii::$app->formatter->asDate($article->created_at) ?></small>
                        </div>
                    </div>

                    <h2 class="mb-3"><?= Html::a(Html::encode($article->title), ['view', 'id' => $article->id]) ?></h2>

                    <div class="mb-2">
                        <?php foreach ($article->tags as $tag): ?>
                            <span class="badge bg-light text-dark me-1">#<?= Html::encode($tag->name) ?></span>
                        <?php endforeach; ?>
                    </div>

                    <p class="mt-3"><?= nl2br(Html::encode(substr($article->content, 0, 200) . '...')) ?></p>

                    <?php if (Yii::$app->user->id === $article->created_by): ?>
                        <div class="mt-4">
                            <?= Html::a('Edit', ['articles/update', 'id' => $article->id], ['class' => 'btn btn-sm btn-warning']) ?>
                            <?= Html::a('Manage', ['articles/manage', 'id' => $article->id], ['class' => 'btn btn-sm btn-secondary']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You have no posts.</p>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="card mb-4 text-center p-3">
                <img src="<?= Yii::$app->user->identity->profile_picture ?? '/web/images/default.png' ?>"
                    class="rounded-circle mx-auto mb-2" style="width: 60px; height: 60px;">
                <strong><?= Html::encode(Yii::$app->user->identity->username) ?></strong>
                <p class="text-muted mt-2 mb-0">
                    Joined<br><?= Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at) ?>
                </p>
            </div>
        <?php endif; ?>

        
    </div>
</div>