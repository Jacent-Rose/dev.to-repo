<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;

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

<head>
    <style>
        input[type="search"]::-webkit-search-cancel-button {
            display: none;
        }
    </style>

    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
    <?php
    $controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;

    // Only show navbar if not on create-post page
    $hideNavbar = ($controller === 'articles' && $action === 'create-posts');
    ?>
    <?php if (!$hideNavbar): ?>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <!-- DEV Logo -->
                <a href="<?= Yii::$app->homeUrl ?>" style="margin-left: 10px;">
                    <img src="https://d2fltix0v2e0sb.cloudfront.net/dev-black.png"
                        alt="DEV Logo"
                        style="height: 38px; width: 45px; border-radius: 1px; ">
                </a>

                <!-- Toggle for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Centered Search Bar -->
                    <form class="d-flex mx-auto" action="<?= Yii::$app->urlManager->createUrl(['site/search']) ?>"
                        method="get" style="width: 80%; padding-right:200px;">
                        <input class="form-control me-2" type="search" name="q" placeholder="Search..." aria-label="Search">
                        <a href="https://www.algolia.com/developers?utm_source=devto&utm_medium=referral"
                            target="_blank" style="text-decoration: none; color: #000;">
                            <span class="powered-by" style="position: absolute; right: 460px; top: 50%; transform: translateY(-50%); font-size: 0.9rem; color: #6c757d;">
                                Powered by
                                <?= Html::img(
                                    'web/images/algolia_logo.svg',
                                    [
                                        'alt' => 'Algolia Logo',
                                        'style' => 'height: 20px; vertical-align: middle; filter:grayscale(80%);'
                                    ]
                                ) ?>

                                Algolia
                            </span>
                        </a>

                    </form>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (Yii::$app->user->isGuest): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">Log in</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-outline-primary ms-2"
                                    style="margin-right:10px;"
                                    href="<?= Yii::$app->urlManager->createUrl(['users/sign-up']) ?>">Create account</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <form method="post" action="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">
                                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->getCsrfToken()) ?>
                                    <button type="submit" class="btn btn-link nav-link">
                                        Logout (<?= Html::encode(Yii::$app->user->identity->username) ?>)
                                    </button>
                                </form>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-outline-primary ms-2"
                                    style="margin-right:10px; white-space: nowrap; margin-top: 10px;"
                                    href="<?= Yii::$app->urlManager->createUrl(['articles/create-posts']) ?>">
                                    Create Post
                                </a>
                            </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main" style="margin-top: 80px;">
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; dev <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
