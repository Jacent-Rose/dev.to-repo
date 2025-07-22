<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int|null $created_by
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string|null $created_at
 *
 * @property ArticleTags[] $articleTags
 * @property Comments[] $comments
 * @property Users $createdBy
 * @property Likes[] $likes
 * @property Tags[] $tags
 */
class Articles extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */

     

    public function rules()
    {
        return [
            [['created_by', 'created_at'], 'default', 'value' => null],
            [['created_by'], 'default', 'value' => null],
            [['created_by'], 'integer'],
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
            [['cover_image_file'], 'file', 'extensions' => 'jpg, jpeg, png', 'skipOnEmpty' => true],
        
        ];
        
    }

    public function uploadCoverImage()
{
    if ($this->validate()) {
        $filename = uniqid() . '.' . $this->cover_image_file->extension;
        $path = Yii::getAlias('@webroot/uploads/') . $filename;
        if ($this->cover_image_file->saveAs($path)) {
            $this->cover_image_file = $filename; // Assuming you have a `cover_image` DB field
            return true;
        }
    }
    return false;
}


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_by' => 'Created By',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTags::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['article_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::class, ['id' => 'tag_id'])->viaTable('article_tags', ['article_id' => 'id']);
    }

    public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        if (empty($this->slug)) {
            $this->slug = $this->generateSlug($this->title);
        }
        return true;
    }
    return false;
}


protected function generateSlug($title)
{
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    
    // Ensure uniqueness
    $originalSlug = $slug;
    $i = 1;
    while (Articles::find()->where(['slug' => $slug])->exists()) {
        $slug = $originalSlug . '-' . $i;
        $i++;
    }

    return $slug;
}

public function getIsBookmarkedByUser()
{
    if (Yii::$app->user->isGuest) {
        return false;
    }

    return Bookmarks::find()
        ->where(['user_id' => Yii::$app->user->id, 'article_id' => $this->id])
        ->exists();
}

public function getLikeCount()
    {
        return $this->hasMany(Likes::class, ['article_id' => 'id'])->where(['type' => 'like'])->count();
    }
    public function getFireCount()
{
    return $this->hasMany(Likes::class, ['article_id' => 'id'])->where(['type' => 'fire'])->count();
}


public function getCommentCount()
{
    return $this->getComments()->count();
}

public function getUser()
{
    return $this->getCreatedBy();
}

}
