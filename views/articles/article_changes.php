<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Articles $model */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-create container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                     <!-- DEV Logo -->
                <a href="<?= Yii::$app->homeUrl ?>" style="margin-left: 10px;">
                    <img src="https://d2fltix0v2e0sb.cloudfront.net/dev-black.png"
                        alt="DEV Logo"
                        style="height: 38px; width: 45px; border-radius: 1px; ">
                </a>
                    <span class="ml-2">Create Post</span>
                </div>
                <div>
                    <?= Html::a('Edit', '#', ['class' => 'btn btn-light btn-sm']) ?>
                    <?= Html::a('Preview', '#', ['class' => 'btn btn-light btn-sm ml-2']) ?>
                </div>
            </div>

            <div class="card shadow-sm p-3">
                <?php $form = ActiveForm::begin(); ?>

                <div class="mb-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm">Add a cover image</button>
                </div>

                <?= $form->field($model, 'title')->textInput(['placeholder' => 'New post title here...'])->label(false) ?>

                <div class="mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Add up to 4 tags...">
                </div>

                <div class="mb-2">
                    <div class="btn-toolbar" role="toolbar" aria-label="Text formatting toolbar">
                        <div class="btn-group mr-2" role="group" aria-label="Basic styles">
                            <button type="button" class="btn btn-light btn-sm"><b>B</b></button>
                            <button type="button" class="btn btn-light btn-sm"><i>I</i></button>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Links and lists">
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-link"></i></button>
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-list-ul"></i></button>
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-list-ol"></i></button>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Headings and quotes">
                            <button type="button" class="btn btn-light btn-sm">H</button>
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-quote-left"></i></button>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Code and embeds">
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-code"></i></button>
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-bolt"></i></button>
                            <button type="button" class="btn btn-light btn-sm"><i class="far fa-image"></i></button>
                        </div>
                        <div class="btn-group" role="group" aria-label="More options">
                            <button type="button" class="btn btn-light btn-sm"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                    </div>
                </div>

                <?= $form->field($model, 'content')->textarea(['rows' => 10, 'placeholder' => 'Write your post content here...'])->label(false) ?>

                <hr class="my-4">

                <div class="d-flex justify-content-start align-items-center">
                    <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary mr-2']) ?>
                    <?= Html::button('Save draft', ['class' => 'btn btn-outline-secondary mr-2']) ?>
                    <button type="button" class="btn btn-light btn-sm"><i class="fas fa-redo"></i> Revert new changes</button>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>