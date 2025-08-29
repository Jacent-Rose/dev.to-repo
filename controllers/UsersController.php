<?php

namespace app\controllers;

use app\models\Articles;
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
        $this->layout = 'sign-up';
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
        $user = Users::findOne($id); // Get single user

        if (!$user) {
            Yii::$app->session->setFlash('error', 'User not found.');
            return $this->redirect(['site/index']);
        }

        $articles = $user->articles; // Get user's articles
        $comments = $user->getComments()->count(); // Number of comments written
        $likes = []; // Fetch this if implemented

        return $this->render('view_users', [
            'user' => $user,
            'articles' => $articles,
            'comments' => $comments,
            'likes' => $likes
        ]);
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

    public function actionEditProfile($id)
    {
        $this->layout = 'sign-up';
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'User not found.');
            return $this->redirect(['view-users', 'id' => Yii::$app->user->id]);
        }

        // Store the old profile picture path temporarily
        $oldProfilePicture = $user->profile_picture;

        if ($user->load(Yii::$app->request->post())) {
            $profileImage = UploadedFile::getInstance($user, 'profile_picture');

            if ($profileImage) {
                // A new image was uploaded
                $imagePath = '/uploads/' . Yii::$app->security->generateRandomString() . '.' . $profileImage->extension;
                if ($profileImage->saveAs(Yii::$app->basePath . '/web' . $imagePath)) {
                    // Delete the old image if it's not the default
                    if ($oldProfilePicture && $oldProfilePicture !== '/web/images/default-profile.png') {
                        $oldImagePath = Yii::$app->basePath . '/web' . $oldProfilePicture;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    $user->profile_picture = $imagePath;
                }
            } else {
                // No new image uploaded, retain the old one
                $user->profile_picture = $oldProfilePicture;
            }

            // Save the updated user
            if ($user->save(false)) {
                Yii::$app->session->setFlash('success', 'Profile updated successfully.');
                return $this->redirect(['view-users', 'id' => Yii::$app->user->id]);
            } else {
                Yii::error('Error updating profile: ' . print_r($user->errors, true));
                Yii::$app->session->setFlash('error', 'Failed to update profile. Please check the form.');
            }
        }

        return $this->render('edit_profile', ['user' => $user]);
    }


    public function actionTestEmail()
    {
        Yii::$app->mailer->compose()
            ->setFrom(['confirmemailtesting@gmail.com' => 'DevClone'])
            ->setTo('rosejacent@gmail.com')
            ->setSubject('Test Email from DevClone')
            ->setTextBody('This is a plain text test email.')
            ->send();

        return 'Test email sent!';
    }

    public function actionUpdateBio()
    {
        if (Yii::$app->request->isPost && !Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;
            $bio = Yii::$app->request->post('bio');
            $user->bio = $bio;

            if ($user->save(false)) {
                Yii::$app->session->setFlash('success', 'Bio updated!');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update bio.');
            }
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['users/profile', 'id' => Yii::$app->user->id]);
    }

}
