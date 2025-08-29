<?php

namespace app\controllers;

use app\models\Articles;
use app\models\Comments;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Likes;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Articles::find()

            ->all();

        return $this->render('index', ['model' => $model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionReact($id, $type)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $userId = Yii::$app->user->id;
        $article = Articles::findOne($id);

        if (!$article) {
            throw new NotFoundHttpException("Article not found.");
        }

        // Check if user already reacted with the same type
        $existing = Likes::find()
            ->where(['article_id' => $id, 'user_id' => $userId, 'type' => $type])
            ->one();

        if ($existing) {
            // Remove reaction if already exists
            $existing->delete();
        } else {
            // Add new reaction
            $like = new Likes();
            $like->article_id = $id;
            $like->user_id = $userId;
            $like->type = $type;
            $like->created_at = date('Y-m-d H:i:s');
            $like->save();
        }

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index', 'slug' => $article->slug]);
    }



    public function actionComment($id)
    {
        $article = Articles::find()
            ->where(['id' => $id])
            ->with(['comments.user']) // Load comments and their users
            ->one();
    
        if (!$article) {
            throw new \yii\web\NotFoundHttpException('Article not found.');
        }
    
        $newComment = new Comments();
    
        if (!Yii::$app->user->isGuest && Yii::$app->request->isPost) {
            $newComment->load(Yii::$app->request->post());
            $newComment->article_id = $article->id;
            $newComment->user_id = Yii::$app->user->id;
            $newComment->created_at = date('Y-m-d H:i:s');
    
            if ($newComment->save()) {
                Yii::$app->session->setFlash('success', 'Comment posted successfully.');
                return $this->redirect(['site/comment', 'id' => $id]);
            }
        }
    
        return $this->render('comments', [
            'article' => $article,
            'comments' => $article->comments,
            'newComment' => $newComment,
        ]);
    }
    
    
    
}
