<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha2;
?>

<style>
html, body, .site-signup {
  background-color: #f9f9f9;
  font-family: 'Segoe UI', sans-serif;
}

.signup-container {
  max-width: 500px;
  margin: 60px auto;
  padding: 40px;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
  animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.signup-container h5 {
  font-size: 1.5rem;
  text-align: center;
  font-weight: 600;
  margin-bottom: 10px;
}

.signup-container .subtitle {
  text-align: center;
  color: #666;
  font-size: 0.95rem;
  margin-bottom: 25px;
}

.form-field {
  margin-bottom: 20px;
}

.form-control {
  border-radius: 8px;
  border: 1px solid #ccc;
  padding: 12px;
  font-size: 1rem;
  box-shadow: none !important;
}

input[type="file"] {
  padding: 5px;
  border: none;
}

.image-preview {
  display: none;
  margin-bottom: 20px;
  text-align: left;
  
}

.image-preview img {
    width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  aspect-ratio: 1 / 1;
  box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
}

.btn-primary {
  background-color: #3b49df;
  border-radius: 8px;
  font-weight: 600;
  padding: 8px 16px; 
  font-size: 1rem;
  
  border: none;
  transition: background-color 0.3s ease;
}


.btn-primary:hover {
  background-color: #2c3fcc;
}

.login-prompt {
  text-align: center;
  font-size: 0.95rem;
  color: #555;
  margin-top: 20px;
}

.login-link {
  color: #3b49df;
  font-weight: 600;
  text-decoration: none;
}

.recaptcha {
  margin-top: -10px;
}
</style>

<div class="site-signup">
  <div class="signup-container">
    <h5><b>Create your account</b></h5>
    <div class="subtitle">Join our community – it's quick and easy.</div>

    <?php $form = ActiveForm::begin([
      'id' => 'signup-form',
      'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <!-- Image Preview -->
    <div class="image-preview" id="imagePreview">
      <img id="previewImg" src="#" alt="Profile Preview">
    </div>

    <div class="form-field">
    <?= $form->field($model, 'profile_picture', [
    'template' => "{input}\n{error}",
])->fileInput([
    'id' => 'profilePictureInput',
    'class' => 'form-control-file custom-file-input',
    'accept' => 'image/*'
]) ?>
 <?= $form->field($model, 'profile_picture', [
        'template' => "{input}\n{error}",
    ])->fileInput([
        'id' => 'profilePictureInput',
        'class' => 'custom-file-input',
        'accept' => 'image/*',
        'style' => 'display:none;' // hide actual input
    ]) ?>

    <label for="profilePictureInput" id="uploadLabel" class="custom-upload-label text-danger">
        Upload a profile picture
    </label>

    </div>

    <div class="form-field">
      <?= $form->field($model, 'name')->textInput(['placeholder' => 'Full name'])->label(false) ?>
    </div>

    <div class="form-field">
      <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username'])->label(false) ?>
    </div>

    <div class="form-field">
      <?= $form->field($model, 'email')->input('email', ['placeholder' => 'Email'])->label(false) ?>
    </div>

    <div class="form-field">
      <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
    </div>

    <div class="form-field">
      <?= $form->field($model, 'password_confirmation')->passwordInput(['placeholder' => 'Confirm password'])->label(false) ?>
    </div>

    <div class="recaptcha form-field">
      <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::class, [
        'siteKey' => Yii::$app->params['recaptchaSiteKey']
      ])->label(false) ?>
    </div>

    <div class="form-field">
      <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="login-prompt">
      Already have an account?
      <a href="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>" class="login-link">Log in</a>
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('profilePictureInput');
    const uploadLabel = document.getElementById('uploadLabel');

    fileInput.addEventListener('change', function () {
      if (fileInput.files.length > 0) {
        uploadLabel.textContent = 'Profile picture uploaded';
        uploadLabel.classList.remove('text-danger');
        uploadLabel.classList.add('text-success');
      } else {
        uploadLabel.textContent = 'Upload a profile picture';
        uploadLabel.classList.remove('text-success');
        uploadLabel.classList.add('text-danger');
      }
    });
  });
</script>




</div>

<script>
  const input = document.getElementById('profilePictureInput');
  const preview = document.getElementById('imagePreview');
  const previewImg = document.getElementById('previewImg');

  input.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      preview.style.display = 'block';
      reader.addEventListener('load', function () {
        previewImg.setAttribute('src', this.result);
      });
      reader.readAsDataURL(file);
    } else {
      preview.style.display = 'none';
      previewImg.setAttribute('src', '#');
    }
  });
</script>
