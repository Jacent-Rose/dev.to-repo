<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">


<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>

<style>
    .dropdown-toggle::after {
        display: none !important;
    }

    nav.navbar .navbar-nav .nav-item:hover,
    nav.navbar .navbar-nav .nav-item:focus {
        background-color: transparent !important;
    }

    .navbar .navbar-collapse form {
        display: flex;
        align-items: center;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
</style>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <!-- DEV Logo -->
                <a href="<?= Yii::$app->homeUrl ?>" style="margin-left: 10px;">
                    <img src="https://d2fltix0v2e0sb.cloudfront.net/dev-black.png" alt="DEV Logo"
                        style="height: 38px; width: 45px; border-radius: 1px; ">
                </a>

                <!-- Toggle for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="navbarContent">

                    <!-- Search Bar -->
                    <form class="d-flex mx-auto" action="<?= Yii::$app->urlManager->createUrl(['site/search']) ?>"
                        method="get" style="width: 80%; position: relative;">

                        <i class="fas fa-search"
                            style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888;"></i>

                        <input type="search" name="q" class="form-control" placeholder="Search..."
                            style="padding-left: 35px; padding-right: 140px;">

                        <div style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
                          display: flex; align-items: center; font-size: 0.8rem; color: #6c757d;">
                            <a href="https://www.algolia.com" target="_blank"
                                style="text-decoration: none; color: #6c757d; font-size: 0.8rem; display: flex; align-items: center;">
                                Powered by
                                <img src="<?= Url::to(['web/images/algolia_logo.svg']) ?>" alt="Algolia"
                                    style="height: 16px; margin-left: 4px; filter: grayscale(80%);">
                            </a>
                        </div>


                    </form>


                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="< ?= Yii::$app->urlManager->createUrl(['site/login']) ?>">Log
                                    in</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="btn btn-outline-primary ms-2" style="margin-right:10px;"
                                    href="<?= Yii::$app->urlManager->createUrl(['users/sign-up']) ?>">Create account</a>
                            </li>
                        <?php else: ?>

                            <li class="nav-item">
                                <a class="btn btn-outline-primary ms-2" style="margin-right:35px;"
                                    href="<?= Yii::$app->urlManager->createUrl(['articles/create-posts']) ?>">Create
                                    Post</a>
                            </li>
                            <li class="nav-item">
                                <form method="post" action="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">
                                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                                    <?php $user = Yii::$app->user->identity; ?>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle p-0" id="navbarProfile" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                    <?php if ($user->profile_picture): ?>
                                        <img src="<?= Url::to(['web/' . $user->profile_picture]) ?>" alt="Profile Picture"
                                            style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                    <?php else: ?>
                                        <img src="<?= Url::to(['web/images/default.jpg']) ?>" class="" alt="Default"
                                            style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                                    <?php endif; ?>

                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarProfile">
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?= Yii::$app->urlManager->createUrl(['users/view-users', 'id' => Yii::$app->user->id]) ?>">
                                            My Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?= Yii::$app->urlManager->createUrl(['articles/create-posts']) ?>">
                                            Create Post
                                        </a>
                                    </li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="post"
                                            action="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">
                                            <?= \yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>

                            </form>
                            </li>



                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main id="main" class="flex-shrink-0" role="main" style="margin-top: 80px;">
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>