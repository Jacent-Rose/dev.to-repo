<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Html;
use app\models\User;
use Yii;

class WeeklySummaryController extends Controller
{
    public function actionSend()
    {
        $users = User::find()->all();  // Fetch all users

        foreach ($users as $user) {
            // Fetch the user's articles from the last 7 days
            $articles = $user->getArticles()
            ->andWhere(['>=', 'created_at', date('Y-m-d H:i:s', strtotime('-1 minute'))])
            ->all();
        

            if (!empty($articles)) {
                // If articles are found, prepare the HTML content
                $html = "<h3>Your Weekly Article Summary</h3>";
                foreach ($articles as $article) {
                    $likes = $article->getLikes()->count();
                    $comments = $article->getComments()->count();
                    $html .= "<p><strong>" . Html::encode($article->title) . "</strong><br>";
                    $html .= "❤️ Likes: $likes | 💬 Comments: $comments </p>";
                }

                // Send the email to the user
                if (Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom(['confirmemailtesting@gmail.com' => 'DevClone'])
                    ->setSubject('Your Weekly Activity Summary')
                    ->setHtmlBody($html)
                    ->send()) {
                    echo "Email sent to " . $user->email . "\n";  // Success message
                } else {
                    echo "Failed to send email to " . $user->email . "\n";  // Failure message
                }
            } else {
                // If no articles are found for the user, send a notification email
                $html = "<h3>You have no articles this week!</h3>";
                $html .= "<p>There were no posts from you in the last 7 days. Keep up the great work!</p>";

                // Send the email notifying the user of no articles
                if (Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom(['confirmemailtesting@gmail.com' => 'DevClone'])
                    ->setSubject('No Articles This Week')
                    ->setHtmlBody($html)
                    ->send()) {
                    echo "Email sent to " . $user->email . " (No articles this week)\n";  // Success message for no articles
                } else {
                    echo "Failed to send email to " . $user->email . " (No articles this week)\n";  // Failure message for no articles
                }
            }
        }

        echo "Weekly emails sent.\n";  // Final message after all emails are processed
    }
}
