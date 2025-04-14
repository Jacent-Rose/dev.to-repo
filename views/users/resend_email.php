<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

?>


<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-8 shadow-md rounded-md">
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Resend Confirmation Email</h2>

        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300', 'placeholder' => 'Enter your email']) ?>

            <div class="mt-4">
                <?= Html::submitButton('Resend Email', [
                    'class' => 'w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold'
                ]) ?>
            </div>

        <?php ActiveForm::end(); ?>

        <p class="mt-4 text-sm text-gray-600 text-center">
            Already confirmed? <a href="/login" class="text-blue-500 underline">Log in</a>
        </p>
    </div>
</div>
