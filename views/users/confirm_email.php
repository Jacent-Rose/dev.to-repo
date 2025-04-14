<?php

use yii\helpers\Html;

/** @var string $email */
?>

<style>
    .site-confirm-email {
        background-color: #fff;
        padding: 20px;
        margin-top: 200px;

    }

    .site-confirm-email h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }
</style>

<div class="site-confirm-email">
    <div class="h-screen w-screen flex items-center justify-center bg-white px-4">
        <div class="max-w-md w-full text-center">
            <div class="text-5xl mb-6">✅</div>
            <h1 class="text-2xl font-bold mb-4">Great! Now confirm your email address.
            </h1>
            <p class="text-gray-700 text-base mb-6">
                We sent an email to <strong><?= Html::encode($email) ?></strong> with a confirmation link.
                Click the button inside to confirm your email.
            </p>
            <p class="text-gray-600 text-sm">
                <a href="<?= \yii\helpers\Url::to(['resend-email', 'email' => $email]) ?>" class="text-blue-500 underline">
                    Click here
                </a>

                if you didn't get the email...
            </p>
        </div>
    </div>
</div>