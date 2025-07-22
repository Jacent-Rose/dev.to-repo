<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Articles $article */ // Ensure correct model namespace
/** @var app\models\Comments $newComment */ // Ensure correct model namespace

$this->title = 'Comment — ' . Html::encode($article->title);
?>

<style>
    .comment-form-container {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .comment-form-container textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-bottom: 15px;
        font-family: sans-serif; /* Consistent font */
        font-size: 1rem;
        box-sizing: border-box; /* Prevent padding from increasing width */
        resize: vertical; /* Allow vertical resizing */
    }

    .comment-form-container textarea::placeholder {
        color: #999;
    }

    .btn-post-comment {
        background-color: #007bff; /* Primary blue color */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-post-comment:hover {
        background-color: #0056b3;
    }

    .comments-section {
        margin-top: 40px;
    }

    .comment-item {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .comment-item:last-child {
        border-bottom: none;
    }

    .comment-author {
        font-weight: bold;
        margin-right: 8px;
        color: #333;
    }

    .comment-content {
        margin-top: 5px;
        color: #555;
        line-height: 1.6;
    }

    .login-to-comment {
        margin-top: 20px;
        color: #777;
    }

    .login-to-comment a {
        color: #007bff;
        text-decoration: none;
    }

    .login-to-comment a:hover {
        text-decoration: underline;
    }

    .no-comments {
        color: #777;
        margin-top: 20px;
    }
    .page-container,html,body {
        background-color: #f9f9f9;
    }
    .right-sidebar {
        width: 130%;
        /* Adjusted to 4 parts */
        
    }
    
</style>

<div class="page-container">
  <div class="row">
    <div class="col-8" style="margin-left: -55px;" >
<h3><?= Html::encode($article->title) ?></h3>

<div class="comment-form-container">
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php $form = ActiveForm::begin([
            'action' => ['site/comment', 'id' => $article->id], // Ensure article ID is passed
            'method' => 'post',
        ]); ?>

        <?= $form->field($newComment, 'content')->textarea(['rows' => 5, 'placeholder' => 'Leave a comment...'])->label(false) ?>
        <?= Html::submitButton('Post Comment', ['class' => 'btn btn-primary btn-post-comment']) ?>

        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <p class="login-to-comment"><a href="<?= Url::to(['site/login']) ?>">Log in</a> to comment.</p>
    <?php endif; ?>
</div>

<div class="comments-section">
    <h4>Comments</h4>
    <?php if (!empty($article->comments)): ?>
        <?php foreach ($article->comments as $comment): ?>
            <div class="comment-item">
                <strong class="comment-author"><?= Html::encode($comment->user->name) ?>:</strong>
                <p class="comment-content"><?= Html::encode($comment->content) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-comments">No comments yet.</p>
    <?php endif; ?>
</div>

    </div>
    <div class="col-4">
        
        <div class="right-sidebar" >
            <div class="sidebar-content card mb-3">
                <div class="card-header" style="background-color: #f9f9f9;">What's happening this week</div>
                <div class="card-body">
                    <h5>Challenges <span role="img" aria-label="smiling face with sunglasses">😎</span></h5>
                    <div class="card">
                        <a href="#" class="text-decoration-none text-dark">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Challenge Image">
                            <div class="card-body">
                                <h6 class="card-title">Alibaba Cloud Web Game Challenge</h6>
                                <p class="card-text"><small class="text-muted">Get your submissions in early!</small></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebar-content card mb-3">
                <div class="card-body">
                    <p class="card-text">Have a great week <span role="img" aria-label="heart">❤️</span></p>
                </div>
            </div>
            <div class="sidebar-content card">
                <div class="card-header" style="background-color: #f9f9f9;" style="background-color: #f9f9f9;">#discuss</div>
                <div class="card-body">
                    <p class="card-text"><small>Discussion threads targeting the whole community</small></p>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted small">Meme Monday <span class="badge bg-light text-muted float-end">42 comments</span></a></li>
                        <li><a href="#" class="text-decoration-none text-muted small mt-2">Beginner <span class="badge bg-light text-muted float-end">18 comments</span></a></li>
                        <li><a href="#" class="text-decoration-none text-muted small mt-2">Career Advice <span class="badge bg-light text-muted float-end">25 comments</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>