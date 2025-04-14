<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookmarks".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $article_id
 * @property string|null $created_at
 *
 * @property Articles $article
 * @property Users $user
 */
class Bookmarks extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookmarks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id'], 'default', 'value' => null],
            [['user_id', 'article_id'], 'default', 'value' => null],
            [['user_id', 'article_id'], 'integer'],
            [['created_at'], 'safe'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::class, 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'article_id' => 'Article ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Articles::class, ['id' => 'article_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

}
