<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha2;

?>
<div class="site-signup">
    <div class="signup-container">
        <h5>
            <b>
                Create your account
            </b>
        </h5>


        <?php $form = ActiveForm::begin([
            'id' => 'signup-form',
            'options' => ['enctype' => 'multipart/form-data'], // for file upload
        ]); ?>
        <div class="form-field">
            <?= $form->field($model, 'profile_picture')->fileInput()->label('Profile image') ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'name') ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'username') //->textInput(['placeholder' => 'Username'])->label(false) 
            ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'email') //->input('email', ['placeholder' => 'Email'])->label(false) 
            ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>
        </div>

        <div class="form-field">
            <?= $form->field($model, 'password_confirmation')->passwordInput(['class' => 'form-control']) ?>
        </div>

        <div class='recaptcha'>
            <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::class, [
                'siteKey' => Yii::$app->params['recaptchaSiteKey']
            ])->label(false) ?>
        </div>

        <div class="form-group mt-3" style="text-align: left;">
            <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary']) ?>
        </div>




        <?php ActiveForm::end(); ?>

        <!-- Login Prompt -->
        <div class="login-prompt">
            <p>Already have an account? <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="login-link">Log in</a></p>
        </div>

    </div>
</div>

<style>
    html,
    body,
    .site-signup {
        background-color: #fff;

    }
    .recaptcha{
        margin-top: -10px;
    }

    .signup-container {
        max-width: 600px;
        margin: 80px auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 10px;
       
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
    }

    .required label:after {
        content: " *";
        color: red;
    }

    .signup-container h2 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .signup-container .subtitle {
        text-align: center;
        color: #555;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }

    .form-field {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #3b49df;
        color: white;
        font-weight: 600;
        padding: 10px 15px;
        border: none;
    }

    .btn-block {
        width: 100%;
    }

    .login-prompt {
        text-align: center;
        font-size: 0.95rem;
        color: #444;
    }

    .login-link {
        color: #3b49df;
        font-weight: 600;
    }

    h5 {
        margin-bottom: 30px;
    }
</style>