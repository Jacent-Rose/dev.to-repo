<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    body,
    html,
    .site-login {
        background-color: #f9f9f9;
    }

    .site-login {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-container {
        width: 500px;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        /* margin-top: 0px !important; */
    }

    /* 1) Override the layout's inline margin on #main just for this page */
    #main {
        margin-top: 56px !important;
        /* was 80px — set near your navbar height */
    }

    /* 2) Stop vertical centering; pin the form nearer the top */
    .site-login {
        height: auto !important;
        /* undo 100vh if you like */
        min-height: calc(100vh - 56px);
        /* keep page tall enough under navbar */
        display: flex;
        justify-content: center;
        align-items: flex-start !important;
        /* move form to the top */
        padding-top: 40px;
        /* small breathing room */
    }

    .auth-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    .auth-subtitle {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 25px;
        text-align: center;
    }

    .form-field {
        margin-bottom: 18px;
    }

    .form-field input {
        border-radius: 8px;
        padding: 8px;
        font-size: 1rem;
        border: 1px solid #ddd;
    }

    .forgot-password {
        font-size: 0.9rem;
        color: #3b49df;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .btn-primary {
        background-color: #3b49df;
        color: #fff;
        font-weight: 500;
        padding: 8px;
        border-radius: 6px;
        border: none;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #2c37a0;
    }

    .auth-footer {
        margin-top: 20px;
        text-align: center;
        font-size: 0.95rem;
    }

    .auth-link {
        color: #3b49df;
        font-weight: 600;
        text-decoration: none;
    }

    .auth-link:hover {
        text-decoration: underline;
    }

    input:focus,
    textarea:focus,
    select:focus {
        outline: none !important;
        /* removes the default blue outline */
        box-shadow: none !important;
        /* removes the blue shadow */
        border-color: #80bdff;
        /* optional: you can set a custom border color */
    }

    .form-field label {
  font-size: 0.9rem;       /* smaller text */
  font-weight: 500;        /* lighter than bold */
  color: #444;             /* softer gray */
  margin-bottom: 4px;      /* tight spacing */
  display: block;
}

    /* Make the checkbox smaller */
    #login-form .form-check-input {
        width: 10px !important;
        height: 10px !important;
        margin-top: 2.8px !important;
        margin-right: 6px !important;
    }
    .mb-3.field-loginform-rememberme label {
    font-size: 4px !important;   /* change number as you like */
}
.form-field label::after {
    content: " *"; /* add asterisk */
    color: red;
    margin-left: 2px;
    font-weight: 500;
}


</style>


<div class="site-login">
    <div class="auth-container">
        <h2 class="auth-title"><?= Html::encode($this->title) ?></h2>
        <p class="auth-subtitle">Welcome back! Please login to continue.</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'auth-form'],
        ]); ?>

        <div class="form-field">
            <?= $form->field($model, 'username')
                ->textInput(['autofocus' => true])
                ->label('Username') ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'password')
                ->passwordInput()
                ->label('Password') ?>
        </div>

        <div class="form-field d-flex justify-content-between align-items-center">
            <?= $form->field($model, 'rememberMe')->checkbox(['label' => 'Remember me']) ?>
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Login', [
                'class' => 'btn btn-primary w-100',
                'name' => 'login-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <!-- <div class="auth-footer">
            <p>Don’t have an account?
                <a href="< ?= Yii::$app->urlManager->createUrl(['users/sign-up']) ?>" class="auth-link">Create one</a>
            </p>
        </div> -->
    </div>
</div>