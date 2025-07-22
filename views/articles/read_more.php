<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Users;
?>

<div class='row'>
    <div class='col-8'>
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <article class="article-view bg-white p-4 rounded shadow-sm">

                        <!-- Article Header -->
                        <header class="article-header mb-3">
                            <h1 class="fw-bold mb-2"><?= Html::encode($article->title) ?></h1>

                            <div class="author-info d-flex align-items-center mb-2">
                                <?php if ($author): ?>
                                    <a href="<?= Url::to(['users/view-users', 'id' => $author->id]) ?>" class="d-flex align-items-center text-decoration-none text-dark">
                                        
                                        <img src="<?= $author->profile_picture ? Url::to('@web/' . $author->profile_picture) : Url::to('@web/images/default-profile.png') ?>"
                                            alt="<?= Html::encode($author->name) ?>"
                                            class="rounded-circle me-2"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        <strong><?= Html::encode($author->name) ?></strong>
                                    </a>

                                <?php else: ?>
                                    <span class="text-muted">Unknown Author</span>
                                <?php endif; ?>
                                <span class="ms-3 text-muted">Posted on <?= Yii::$app->formatter->asDate($article->created_at, 'MMM d, Y') ?></span>
                            </div>

                            <?php if (!empty($article->cover_image_file)): ?>
                                <img src="<?= Url::to('@web/web/cover_images/' . $article->cover_image_file) ?>"
                                    class="img-fluid rounded mb-3"
                                    style="max-height: 600px !important; object-fit: cover;"
                                    alt="Cover Image">
                            <?php endif; ?>
                        </header>

                        <!-- Article Content -->

                        <div class="article-content mb-4">
                            <?= Yii::$app->formatter->asNtext($article->content) ?>
                        </div>

                        <!-- Tags -->
                        <?php if (!empty($article->hashtags)): ?>
                            <div class="mb-3">
                                <strong>Tags:</strong>
                                <?php foreach ($article->hashtags as $tag): ?>
                                    <a href="<?= Url::to(['hashtag/view', 'name' => $tag->name]) ?>" class="badge bg-light border text-muted text-decoration-none me-1">#<?= Html::encode($tag->name) ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Reactions & Comments -->
                        <div class="d-flex align-items-center text-muted small mb-3">
                            <span class="me-3">
                                ❤️ <?= $article->getLikes()->where(['type' => 'like'])->count() ?>
                                🔥 <?= $article->getLikes()->where(['type' => 'fire'])->count() ?>
                                🙌 <?= $article->getLikes()->where(['type' => 'clap'])->count() ?>
                                😍 <?= $article->getLikes()->where(['type' => 'love'])->count() ?>
                            </span>

                            <span class="me-3"><i class="fa fa-comment"></i> <?= $article->commentCount ?? 0 ?> comments</span>
                            <span class="me-auto"><?= ceil(str_word_count(strip_tags($article->content)) / 200) ?> min read</span>

                            <a href="<?= Url::to(['article/bookmark', 'id' => $article->id]) ?>" class="text-decoration-none">
                                <i class="fa <?= $article->isBookmarkedByUser ? 'fa-bookmark' : 'fa-bookmark-o' ?> text-muted"></i>
                            </a>
                        </div>

                        <!-- Comments Section (Placeholder) -->
                        <div id="comments" class="mt-4">
                            <h5>Comments</h5>
                            <p class="text-muted">Comments section coming soon...</p>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class='col-8'>
        <?php if (!empty($recentArticles)): ?>
            <div class="container mt-5">
                <h4 style="margin-left: 60px; margin-bottom: 10px;">More posts you might like</h4>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <?php foreach ($recentArticles as $recent): ?>
                            <div class="card mb-4 shadow-sm">
                                <?php if (!empty($recent->cover_image_file)): ?>
                                    <img src="<?= Url::to('@web/web/cover_images/' . $recent->cover_image_file) ?>"
                                        class="card-img-top"
                                        alt="Cover"
                                        style="height: 400px; object-fit: cover;">
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title mb-2">
                                        <?= Html::a(Html::encode($recent->title), ['articles/read-more', 'id' => $recent->id], ['class' => 'text-dark text-decoration-none']) ?>
                                    </h5>

                                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2 text-muted small">
                                        <span>
                                            <?= $recent->createdBy->username ?? 'Unknown' ?> • <?= date('M j, Y', strtotime($recent->created_at)) ?>
                                        </span>
                                        <span><?= ceil(str_word_count(strip_tags($recent->content)) / 200) ?> min read</span>
                                    </div>

                                    <!-- Reactions & Comments -->
                                    <div class="d-flex align-items-center text-muted small">
                                        <span class="me-3">
                                            ❤️ <?= $recent->getLikes()->where(['type' => 'like'])->count() ?>
                                            🔥 <?= $recent->getLikes()->where(['type' => 'fire'])->count() ?>
                                            🙌 <?= $recent->getLikes()->where(['type' => 'clap'])->count() ?>
                                            😍 <?= $recent->getLikes()->where(['type' => 'love'])->count() ?>
                                        </span>
                                        <span class="me-3">
                                            💬 <?= $recent->getComments()->count() ?> comments
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>


<?php
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>