<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="login-container">
        <h2 class="login-title"><?= Html::encode($this->title) ?></h2>
        <p class="login-subtitle">Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
        ]); ?>

        <div class="form-field">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Username'])->label(false) ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        </div>

        <div class="form-field remember-me">
            <?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Remember me']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="signup-link">
            <p>Don't have an account? <a href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>" class="signup-link-text">Sign up</a></p>
        </div>

    </div>
</div>

<style>
    html,
    body,
    .site-login {
        background-color: #fff;
    }

    .site-login {
        background-color: #fff;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        width: 600px;
        margin: 80px auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.05);
        text-align: left;
    }

    .login-title {
        font-size: 1.8rem;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .login-subtitle {
        color: #555;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .form-field {
        margin-bottom: 20px;
    }

    .form-field input {
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        border: 1px solid #ddd;
    }

    .remember-me {
        text-align: left;
    }

    .btn-primary {
        background-color: #3b49df;
        color: white;
        font-weight: 600;
        padding: 12px;
        border-radius: 8px;
        border: none;
    }

    .btn-primary:hover {
        background-color: #3248b7;
    }

    .signup-link {
        margin-top: 15px;
        font-size: 0.9rem;
    }

    .signup-link-text {
        color: #3b49df;
        font-weight: bold;
    }

    .signup-link-text:hover {
        text-decoration: underline;
    }

    .login-form {
        margin-top: 20px;
    }
</style>