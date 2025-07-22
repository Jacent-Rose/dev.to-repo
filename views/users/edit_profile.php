<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user app\models\Users */
?>

<style>
    .edit-profile-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 40px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .edit-profile-container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .form-field {
        margin-bottom: 20px;
    }

    .required label:after {
        content: " *";
        color: red;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .profile-image-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .profile-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="edit-profile-container">
    <h2>Edit Profile</h2>

    <?php $form = ActiveForm::begin([
        'id' => 'edit-profile-form',
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <div class="form-field">
        <?php if (!empty($user->profile_picture)): ?>
                <img src="<?= Url::to(['web/' . $user->profile_picture]) ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="<?= Url::to(['web/images/default.jpg']) ?>" class="" alt="Default">
            <?php endif; ?>
        <?= $form->field($user, 'profile_picture')->fileInput()->label('Update Profile Image') ?>
    </div>

    <div class="form-field">
        <?= $form->field($user, 'name')->textInput(['placeholder' => 'Your Name']) ?>
    </div>

    <div class="form-field">
        <?= $form->field($user, 'username')->textInput(['placeholder' => 'Username']) ?>
    </div>

    <div class="form-field">
        <?= $form->field($user, 'email')->input('email', ['placeholder' => 'Email']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>