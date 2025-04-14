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

class ArticlesController extends Controller
{
    public function actionCreatePosts()
    {
        $model = new Articles();
        if ($model->load(Yii::$app->request->post())) {
             $model->created_by = Yii::$app->user->identity->id;
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Post Created successfully'); 
            return $this->redirect(['view-articles', 'id' => Yii::$app->user->id]);
        }
        return $this->render('articles_form', ['model' => $model]);
    }

    Public function actionLatest()
    {
        $model= Articles::find()
        ->orderBy(['created_at' => SORT_DESC])
        ->all();
        return $this->render('../site/index', ['model' => $model]);   
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




}
