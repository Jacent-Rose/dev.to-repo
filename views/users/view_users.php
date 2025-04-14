<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\Users */
/* @var $posts app\models\Articles[] */
/* @var $followingTags array // You'll need to fetch this data */
/* @var $commentsWritten int // You'll need to calculate this */

$this->title = $user->username ?? 'Profile';
?>

<div class="profile-view">
    <div class="profile-header">
        <div class="profile-image-container">
            <img src="<?= $user->profile_picture ? Url::to($user->profile_picture) : '/web/images/default-profile.png' ?>" alt="<?= Html::encode($user->username ?? 'User') ?>" class="profile-image">
        </div>
        <div class="profile-info">
            <h1 class="profile-name"><?= Html::encode($user->username ?? 'User') ?></h1>
            <p class="profile-bio"><?= Html::encode($user->bio ?? '404 bio not found') ?></p>
            <p class="profile-joined">🎂 Joined on <?= Yii::$app->formatter->asDate($user->created_at, 'MMM dd, YYYY') ?></p>
        </div>
        <div class="profile-actions">
            <?= Html::a('Edit profile', ['users/update', 'id' => $user->id], ['class' => 'button-edit-profile']) ?>
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-sidebar">
            <div class="sidebar-item">
                <span class="icon">📝</span>
                <span><?= count($posts) ?> posts published</span>
            </div>
            <div class="sidebar-item">
                <span class="icon">💬</span>
                <span><?= $commentsWritten ?? 0 ?> comments written</span>
            </div>
            <div class="sidebar-item">
                <span class="icon">#</span>
                <span><?= count($followingTags) ?> tag followed</span>
            </div>
        </div>

        <div class="profile-main-content">
            <h2>Posts</h2>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-item">
                        <div class="post-header">
                            <div class="post-author-image-container">
                                <img src="<?= $user->profile_picture ? Url::to($user->profile_picture) : '/web/images/default-profile.png' ?>" alt="<?= Html::encode($user->username ?? 'User') ?>" class="post-author-image">
                            </div>
                            <div class="post-author-info">
                                <span class="post-author-name"><?= Html::encode($user->username ?? 'User') ?></span>
                                <span class="post-date"><?= Yii::$app->formatter->asDate($post->created_at, 'MMM dd') ?></span>
                            </div>
                        </div>
                        <h3 class="post-title"><?= Html::a(Html::encode($post->title), ['articles/view', 'slug' => $post->slug]) ?></h3>
                        <?php if (!empty($post->articleTags)): ?>
                            <div class="post-tags">
                                <?php foreach ($post->articleTags as $articleTag): ?>
                                    <span class="post-tag"><?= Html::encode($articleTag->tag->name) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="post-actions">
                            <?= Html::a('💬 Add Comment', ['articles/view', 'slug' => $post->slug, '#' => 'comments']) ?>
                            <span class="post-read-time"><?= $post->read_time ?? '1 min' ?> read</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts published yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    /* ... (Your CSS from the previous response) ... */
</style>