<?php

use yii\helpers\Url;

$this->registerCssFile('@web/web/css/site-index.css', [
    'depends' => [\app\assets\AppAsset::class]
]);
?>

<!-- Logos column -->
<div class="logos-column">
            <ul class="list-unstyled d-flex flex-column align-items-center">
                <li class="mb-3">
                    <a href="#" title="DEV Community">
                        <img src="<?= Url::to(['web/images/logos_col/l02.png']) ?>" alt="DEV" class="logo-icon">
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" title="GG">
                        <img src="<?= Url::to(['web/images/logos_col/l03.png']) ?>" alt="GG" class="logo-icon">
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" title="Forem">
                        <img src="<?= Url::to(['web/images/logos_col/l04.png']) ?>" alt="Forem" class="logo-icon">
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" title="CodeNewbie">
                        <img src="<?= Url::to(['web/images/logos_col/l05.png']) ?>" alt="CodeNewbie"
                            class="logo-icon">
                    </a>
                </li>
            </ul>
        </div>
