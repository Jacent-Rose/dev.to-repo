<?php
/** @var \app\models\User $user */
/** @var \app\models\Article[] $articles */
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h2>Hello <?= Html::encode($user->name) ?> 👋,</h2>

<p>Here's your weekly summary from <strong>DevClone</strong>:</p>

<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <hr>
        <h3><?= Html::encode($article->title) ?></h3>
        <p><em>Published: <?= Yii::$app->formatter->asDate($article->created_at) ?></em></p>
        <ul>
            <li>❤️ Likes: <?= $article->getLikes()->where(['type' => 'like'])->count() ?></li>
            <li>🔥 Fires: <?= $article->getLikes()->where(['type' => 'fire'])->count() ?></li>
            <li>🙌 Claps: <?= $article->getLikes()->where(['type' => 'clap'])->count() ?></li>
            <li>😍 Loves: <?= $article->getLikes()->where(['type' => 'love'])->count() ?></li>
            <li>💬 Comments: <?= $article->commentCount ?></li>
        </ul>
        <p><?= Html::a('View Post', Url::to(['articles/view-articles', 'slug' => $article->slug], true)) ?></p>
    <?php endforeach; ?>
<?php else: ?>
    <p>You didn't publish any articles this week. Let's get writing! ✍️</p>
<?php endif; ?>

<p>— The DevClone Team</p>
