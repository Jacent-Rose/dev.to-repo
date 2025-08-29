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
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        text-align: center;
    }

    .form-field label {
  font-size: 0.9rem;       /* smaller text */
  font-weight: 500;        /* lighter than bold */
  color: #444;             /* softer gray */
  margin-bottom: 4px;      /* tight spacing */
  display: block;
}

.form-field{
  margin-bottom: 10px;
}

    .required label:after {
        content: " *";
        color: red;
    }

    .btn-primary {
        background-color: #3b49df;
    border-radius: 8px;
    font-weight: 400;
    padding: 6px 12px;
    font-size: 0.9rem;
    border: none;
    transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .profile-image-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 15px; /* center the image */
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

    <!-- <div class="form-field">
        < ?php if (!empty($user->profile_picture)): ?>
                <img src="< ?= Url::to(['web/' . $user->profile_picture]) ?>" alt="Profile Picture">
            < ?php else: ?>
                <img src="< ?= Url::to(['web/images/default.jpg']) ?>" class="" alt="Default">
            < ?php endif; ?>
        < ?= $form->field($user, 'profile_picture')->fileInput()->label('Update Profile Image') ?>
    </div> -->
    <div class="form-field text-center">
    <div class="profile-image-preview">
        <?php if (!empty($user->profile_picture)): ?>
            <img src="<?= Url::to(['web/' . $user->profile_picture]) ?>" alt="Profile Picture">
        <?php else: ?>
            <img src="<?= Url::to(['web/images/default.jpg']) ?>" alt="Default">
        <?php endif; ?>
    </div>

    <?= $form->field($user, 'profile_picture')->fileInput()->label('Update Profile Image') ?>
</div>


<div class="form-field">
      <?= $form->field($user, 'name')->textInput(['Full name'])->label('Full name') ?>
    </div>

    <div class="form-field">
      <?= $form->field($user, 'username')->textInput(['Username'])->label('Username') ?>
    </div>

    <div class="form-field">
      <?= $form->field($user, 'email')->input('email', ['Email'])->label('Email') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update Profile', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>