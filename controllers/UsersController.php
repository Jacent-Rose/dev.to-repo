<?php

namespace app\controllers;

use app\models\User;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class UsersController extends Controller
{
   
    public function actionSignUp()
{
    $model = new User();
    
    // Load the POST data
    if ($model->load(Yii::$app->request->post())) {
        // Generate verification token
        $model->verification_token = Yii::$app->security->generateRandomString();

        // Hash the password
        $hash = Yii::$app->security->generatePasswordHash($model->password);
        $model->password = $hash;

        // Handle file upload
        $profileImage = UploadedFile::getInstance($model, 'profile_picture'); // Get the uploaded file

        if ($profileImage) {
            // Define the path to store the image in the "uploads" folder
            $imagePath = '/uploads/' . Yii::$app->security->generateRandomString() . '.' . $profileImage->extension;
            
            // Save the image file to the "uploads" directory
            if ($profileImage->saveAs(Yii::$app->basePath . '/web/' . $imagePath)) {
                $model->profile_picture = $imagePath;  // Save the file path in the database
            }
        }

        // Save the user data
        $model->save(false);

        // Send email to user
        Yii::$app->mailer->compose()
            ->setFrom('confirmemailtesting@gmail.com')
            ->setTo($model->email)
            ->setSubject('Please Confirm Your Email Address')
            ->setTextBody("Please click the following link to confirm your email address:\n\n" . 
                Yii::$app->urlManager->createAbsoluteUrl(['confirm-email', 'token' => $model->verification_token]))
            ->send();
        
        Yii::$app->session->setFlash('success', 'Thank you for signing up. Please Login.');

        return $this->redirect(['confirm-email', 'email' => $model->email]);
    }

    // Render the sign-up form
    return $this->render('users_form', ['model' => $model]);
}


public function actionViewUsers($id)
{
    // Fetch posts by the specified user (userId)
    $model = Users::find()
    ->where(['id' => $id])
    ->orderBy(['created_at' => SORT_DESC])
    ->all();

    // If no posts are found, redirect or show a message
    if (empty($model)) {
        Yii::$app->session->setFlash('error', '.');
        return $this->redirect(['site/index']);  // Redirect to a relevant page if no posts are found
    }

    // Render the view for individual user posts
    return $this->render('view_use', ['model' => $model]);
}
    public function actionConfirmEmail($email)
{
    return $this->render('confirm_email', ['email' => $email]);
}



public function actionResendEmail()
{
    $model = new Users(); // or create a dedicated form model if needed

    if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
        $user = Users::findOne(['email' => $model->email]);

        if ($user) {
            $user->verification_token = Yii::$app->security->generateRandomString();
            $user->save(false);

            Yii::$app->mailer->compose()
                ->setFrom('confirmemailtesting@gmail.com')
                ->setTo($user->email)
                ->setSubject('Resend Confirmation Email')
                ->setTextBody("Please click the link to confirm your email:\n\n" .
                    Yii::$app->urlManager->createAbsoluteUrl(['confirm-email', 'token' => $user->verification_token]))
                ->send();

            Yii::$app->session->setFlash('success', 'A new confirmation email has been sent.');
        } else {
            Yii::$app->session->setFlash('error', 'Email not found.');
        }
    }

    return $this->render('resend_email', ['model' => $model]);
}

}
