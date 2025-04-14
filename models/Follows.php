<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follows".
 *
 * @property int $id
 * @property int|null $follower_id
 * @property int|null $following_id
 * @property string|null $created_at
 *
 * @property Users $follower
 * @property Users $following
 */
class Follows extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'follows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['follower_id', 'following_id'], 'default', 'value' => null],
            [['follower_id', 'following_id'], 'default', 'value' => null],
            [['follower_id', 'following_id'], 'integer'],
            [['created_at'], 'safe'],
            [['follower_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['follower_id' => 'id']],
            [['following_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['following_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'follower_id' => 'Follower ID',
            'following_id' => 'Following ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Follower]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollower()
    {
        return $this->hasOne(Users::class, ['id' => 'follower_id']);
    }

    /**
     * Gets query for [[Following]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFollowing()
    {
        return $this->hasOne(Users::class, ['id' => 'following_id']);
    }

}
