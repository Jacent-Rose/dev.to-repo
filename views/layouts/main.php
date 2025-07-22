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

<style>
    input[type="search"]::-webkit-search-cancel-button {
        display: none;
    }

    .nav-link.dropdown-toggle::after {
        display: none !important;
    }

    .nav-item:focus:focus,
    .nav-item:hover {
        outline: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
    }

    #footer {
        background-color: #2C3E50 !important; /* Dark background color */
        color: #ECF0F1; /* Light gray text color */
    }

    #footer-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex; /* Arrange list items horizontally */
        justify-content: center; /* Center items horizontally */
    }

    #footer-menu a {
        color: #ECF0F1; /* Light gray text color for links */
        text-decoration: none; /* Remove underline from links */
        font-size: 16px;
    }

    #footer-menu li {
        margin: 0 15px; /* Add spacing between items */
    }

    #footer-menu li a:hover {
        color: blue; /* Change color on primary hover */
    }

    .text-md-end {
        text-align: right !important; /* Align text to the right on medium and larger screens */
    }
</style>

<title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>


<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
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
                                <img src="<?= Url::to(['web/images/algolia_logo.svg']) ?>" alt="Algolia Logo"
                                    style='height: 20px; vertical-align: middle; filter:grayscale(80%);'
                                    ]
                                    ?>

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
                                    <?php $user = Yii::$app->user->identity; ?>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle p-0" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">

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
                                        <a class="dropdown-item" href="<?= Yii::$app->urlManager->createUrl(['users/view-users', 'id' => Yii::$app->user->id]) ?>">
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
                                        <form method="post" action="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>">
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

    <footer id="footer" class="mt-auto py-3" style="background-color:#2C3E50 !important;">
    <div class="container">
        <div class="row text-muted align-items-center"> <div class="col-md-4 text-center text-md-start" style="color: #ECF0F1">&copy; dev <?= date('Y') ?></div>
            <div class="col-md-4 text-center"> <nav class="nav-menu-container" role="navigation">
                    <ul id="footer-menu" class="nav-menu styled clearfix inline-inside">
                        <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Disclaimer</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 text-center text-md-end" style="text-align: right;"> <p style="color: #ECF0F1; margin-bottom: 0;"> Powered by
                    <a href="https://www.algolia.com/developers?utm_source=devto&utm_medium=referral"
                        target="_blank" style="text-decoration: none; color: #ECF0F1;">
                        Algolia
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>


    <?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>