<?php

namespace app\controllers;

use app\models\Articles;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ArticlesController extends Controller
{


    public function actionCreatePosts()
    {
        $model = new Articles();

        if ($model->load(Yii::$app->request->post())) {
            // Get uploaded file instance
            $model->cover_image_file = UploadedFile::getInstance($model, 'cover_image_file');

            if ($model->cover_image_file && $model->validate()) {
                $filename = uniqid() . '.' . $model->cover_image_file->extension;
                $path = Yii::getAlias('@webroot/web/cover_images/') . $filename;

                if ($model->cover_image_file->saveAs($path)) {
                    $model->cover_image_file = $filename; // Save filename to DB
                }
            }

            $model->created_by = Yii::$app->user->identity->id;
            $model->save(false);

            Yii::$app->session->setFlash('success', 'Post Created successfully');
            return $this->redirect(['view-articles', 'id' => Yii::$app->user->id]);
        }

        return $this->render('articles_form', ['model' => $model]);
    }






    public function actionLatest()
    {
        $model = Articles::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('@app/views/site/index', ['model' => $model]);
    }

    public function actionTop()
    {
        $model = Articles::find()
            ->select([
                'articles.*',
                'COUNT(DISTINCT likes.id) AS likesCount',
                'COUNT(DISTINCT comments.id) AS commentsCount',
                '(COUNT(DISTINCT likes.id) + COUNT(DISTINCT comments.id)) AS totalScore'
            ])
            ->leftJoin('likes', 'likes.article_id = articles.id')
            ->leftJoin('comments', 'comments.article_id = articles.id')
            ->groupBy('articles.id')
            ->orderBy(['totalScore' => SORT_DESC])
            ->all();

        return $this->render('../site/index', ['model' => $model]);
    }

    public function actionRelevant()
    {
        $model = Articles::find()
            ->all();
        return $this->render('@app/views/site/index', ['model' => $model]);
    }


    public function actionViewArticles($id)
    {

        $model = Articles::find()
            ->where(['created_by' => $id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        if (empty($model)) {
            Yii::$app->session->setFlash('error', 'You have no posts.');
            return $this->redirect(['site/index']);
        }

        return $this->render('view_articles', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Articles::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            Yii::$app->session->setFlash('success', 'Post updated successfully');
            return $this->redirect(['view-articles', 'id' => Yii::$app->user->id]);
        }

        return $this->render('article_changes', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Articles::findOne($id);
        $model->delete();
        return $this->redirect(['view_articles', 'id' => Yii::$app->user->id]);
    }

    public function actionManage($id)
    {
        $model = Articles::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Post not found');
        }

        return $this->render('manage_post', ['model' => $model]);
    }


    public function actionReadMore($id)
    {
        $article = Articles::findOne($id);
        if (!$article) {
            throw new NotFoundHttpException('Article not found.');
        }

        $author = $article->createdBy;

        // Load some recent or related articles (excluding current one)
        $recentArticles = Articles::find()
            ->where(['<>', 'id', $id])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->all();
        $author = $article->createdBy;
        return $this->render('read_more', [
            'article' => $article,
            'author' => $author,
            'recentArticles' => $recentArticles,
        ]);
    }
}
