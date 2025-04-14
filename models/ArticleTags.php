<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tags".
 *
 * @property int $article_id
 * @property int $tag_id
 *
 * @property Articles $article
 * @property Tags $tag
 */
class ArticleTags extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'required'],
            [['article_id', 'tag_id'], 'default', 'value' => null],
            [['article_id', 'tag_id'], 'integer'],
            [['article_id', 'tag_id'], 'unique', 'targetAttribute' => ['article_id', 'tag_id']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::class, 'targetAttribute' => ['article_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
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
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::class, ['id' => 'tag_id']);
    }

}
