<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */


$this->title = 'Home — DevClone';
?>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet">
</head>


<style>
    body {
        background-color: #f9f9f9;
    }

    .site-index {
        padding-top: 50px;
    }

    .main-container {
        display: flex;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .left-sidebar {
        flex-basis: 25%;
        /* Adjusted to 3 parts */
        max-width: 25%;
        /* Adjusted to 3 parts */
        padding-right: 10px;
        margin-left: -90px;
        margin-top: -55px;
    }

    .feed-container {
        flex-grow: 1;
        padding: 0 25px;
        margin-top: -50px;
        flex-basis: 50%;
        /* Adjusted to 5 parts */
    }

    .main-feed {
        color: #000;
        margin-right: 5px;

    }

    .right-sidebar {
        width: 33.33%;
        /* Adjusted to 4 parts */
        padding-left: 10px;
        margin-right: -90px;
        margin-top: -55px;
        border: 1px solid #e1e1e1;
    }

    .post-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: -15px;
        border: 1px solid #e1e1e1;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.02);
    }

    .post-title {
        font-size: 20px;
        font-weight: bold;
        color: #000;
    }

    .post-meta {
        font-size: 14px;
        color: #888;
        margin-bottom: 10px;
    }

    .sidebar-content {
        background-color: #f9f9f9;
        padding: 20px;

        margin-bottom: 20px;
        height: fit-content;
        border-color: transparent;
        border-width: 0px;
    }

    .nav-link {
        color: #000;
    }

    .nav-item:hover {
        background-color: #e7f1ff;
    }

    h5 a {
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    h5 a:hover {
        color: #0d6efd !important;
        text-decoration: underline;
    }

    .nav-link a:hover {
        color: #0d6efd;
        margin-left: -15px;
        background-color: #e7f1ff;
        border-radius: 5px;
        padding: 8px 80px;
        text-decoration: underline;
    }

    .filters {
        display: flex;
        gap: 15px;
        margin-bottom: 3px;
        margin-top: -5px;
    }

    .sidebar-content.dev-community-card {
        background-color: #fff;
        border: 1px solid #e1e1e1;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.02);
    }

    a.filter-btn {
        text-decoration: none;
        color: #000;
        font-weight: bold;
    }



    .filter-btn {
        background-color: #f9f9f9;
        padding: 8px 15px;
        font-size: 20px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        border: none;
    }

    .filter-btn:hover {
        background-color: #fff;
        color: #0d6efd;
    }

    #profilepic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>

<div class="site-index container">
    <div class="main-container">
        <div class="left-sidebar">
            <div class="sidebar-content dev-community-card">
                <h5>
                    <strong>DEV Community is a community of
                        3,000,045 amazing developers
                    </strong>
                </h5>
                <p>We're a place where coders share, stay up-to-date and grow their careers.</p>
                <?= Html::a('Create account', ['/users/sign-up'], [
                    'class' => 'btn btn-outline-primary',
                    'style' => 'width:200px; margin-left:0px;'
                ]) ?>
                <div class="d-flex justify-content-center">
                    <p class="nav-link" style="margin-top: 10px;">
                        <?= Html::a('Log in', ['/site/login']) ?>
                    </p>
                </div>
            </div>
            <div class="sidebar-content">
                <ul class="nav flex-column" style="margin-top: -30px;">
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="#">🏠 Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🎮 DEV++</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🎙️ Podcasts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🎬 Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🏷️ Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">💡 DEV Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🛍️ Forem Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">❤️ Advertise on DEV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🏆 DEV Challenges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">✨ DEV Showcase</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">😎 About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">📞 Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">🐘 Free Postgres Database</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> 🤔 Software Comparisons</a>
                    </li>
                    <li>
                        <h4 style="margin-left:14px; font-size:16px; margin-top:10px">
                            <b>Others</b>
                        </h4>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">👍 Code of Conduct</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">👓 Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">👀 Terms of use</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="feed-container">
            <div class="filters">
                <button class="filter-btn">
                    <a href="<?= Url::to(['articles/relevant']) ?>" class="filter-btn">Relevant</a>
                </button>
                <a href="../articles/latest" class="filter-btn">Latest</a>

                <button class="filter-btn">
                    <a href="<?= Url::to(['articles/top']) ?>" class="filter-btn">Top</a>

                </button>
            </div>

            <div class="main-feed">
                <?php


                if (!empty($model)): ?>
                    <div class="row row-cols-1 g-4">
                        <?php foreach ($model as $article): ?>
                            <div class="col post-card p-3 border rounded shadow-sm bg-white">
                                <!-- 👤 User Info -->
                                <div class="d-flex align-items-center mb-2">
                                    <div class="profilepic">
                                        <?php if (!empty($article->createdBy->profile_picture)): ?>
                                            <img src="<?= Url::to(['web/' . $article->createdBy->profile_picture]) ?>" alt="Profile Picture" class="" id="profilepic">
                                        <?php else: ?>
                                            <img src="<?= Url::to(['web/images/default.jpg']) ?>" class="" alt="Default" id="profilepic">
                                        <?php endif; ?>
                                    </div>
                                    <div>


                                        <div class="fw-medium"><?= Html::encode($article->createdBy->name ?? 'Unknown') ?></div>
                                        <small class="text-muted"><?= date('M j', strtotime($article->created_at)) ?></small>
                                    </div>
                                </div>

                                <?php if (!empty($article->cover_image_file)): ?>
                                    <a href="<?= Url::to(['articles/read-more', 'id' => $article->id]) ?>">
                                        <img src="<?= Yii::getAlias('@web') . '/web/cover_images/' . $article->cover_image_file ?>"
                                            class="w-100 mb-3 rounded-top"
                                            style="object-fit: cover; max-height: 400px;"
                                            alt="Cover Image">
                                    </a>
                                <?php endif; ?>

                                <!-- 📝 Title -->
                                <div class="post-title">
                                    <h5 class="fw-bold mt-2 mb-1" style='color: #000;'>
                                        <?= Html::a(
                                            Html::encode($article->title),
                                            ['articles/read-more', 'id' => $article->id],
                                            ['class' => 'text-dark text-decoration-none']
                                        ) ?>
                                    </h5>
                                </div>

                                <!-- 🏷️ Hashtags -->
                                <?php if (!empty($article->hashtags)): ?>
                                    <div class="mb-2">
                                        <?php foreach ($article->hashtags as $tag): ?>
                                            <a href="<?= Url::to(['hashtag/view', 'name' => $tag->name]) ?>" class="badge bg-light border text-muted text-decoration-none me-1">#<?= Html::encode($tag->name) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <!-- 💬 Reactions & Comments -->
                                <div class="d-flex align-items-center text-muted small mb-2">

                                    <span class="me-3">
                                        <a href="<?= Url::to(['site/react', 'id' => $article->id, 'type' => 'like']) ?>" class="text-decoration-none">❤️</a>
                                        <?= $article->getLikes()->where(['type' => 'like'])->count() ?>

                                        <a href="<?= Url::to(['site/react', 'id' => $article->id, 'type' => 'fire']) ?>" class="text-decoration-none">🔥</a>
                                        <?= $article->getLikes()->where(['type' => 'fire'])->count() ?>

                                        <a href="<?= Url::to(['site/react', 'id' => $article->id, 'type' => 'clap']) ?>" class="text-decoration-none">🙌</a>
                                        <?= $article->getLikes()->where(['type' => 'clap'])->count() ?>

                                        <a href="<?= Url::to(['site/react', 'id' => $article->id, 'type' => 'love']) ?>" class="text-decoration-none">😍</a>
                                        <?= $article->getLikes()->where(['type' => 'love'])->count() ?>
                                    </span>

                                    <a href="<?= Url::to(['site/comment', 'id' => $article->id]) ?>" class="text-decoration-none text-muted me-3">
                                        <i class="fa fa-comment"></i> <?= $article->commentCount ?? 0 ?> comments
                                    </a>

                                    <span class="me-auto"><?= ceil(str_word_count(strip_tags($article->content)) / 200) ?> min read</span>
                                    <a href="<?= Url::to(['article/bookmark', 'id' => $article->id]) ?>" class="text-decoration-none">
                                        <i class="fa <?= $article->isBookmarkedByUser ? 'fa-bookmark' : 'fa-bookmark-o' ?> text-muted"></i>
                                    </a>
                                </div>







                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No articles found.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="right-sidebar">
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