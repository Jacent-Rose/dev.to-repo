<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use yii\web\UploadedFile;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string|null $contact
 * @property string $email
 * @property string $password_hash
 * @property string|null $profile_picture
 * @property string|null $bio
 * @property string|null $created_at
 * @property string $first_name
 * @property string $last_name
 *
 * @property Articles[] $articles
 * @property Comments[] $comments
 * @property Follows[] $follows
 * @property Follows[] $follows0
 * @property Likes[] $likes
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password_confirmation;
    public $reCaptcha;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact', 'profile_picture', 'bio'], 'default', 'value' => null],
            [['username', 'email', 'password', 'name'], 'required'],
            [['bio'], 'string'],
            [['created_at'], 'safe'],
            [['username', 'email', 'password', 'verification_token', 'password_confirmation', 'profile_picture'], 'string', 'max' => 255],
            [['contact'], 'string', 'max' => 15],
            [['email'], 'unique'],
            [['email'], 'email', 'message' => 'Enter a valid email address.'],
            [['username'], 'unique'],
            [['username', 'email', 'password', 'password_confirmation'], 'required', 'message' => 'This field cannot be empty.'],

            //Username Validation
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/', 'message' => 'Username can only contain letters, numbers, and underscores.'],
            ['username', 'string', 'min' => 3, 'max' => 25, 'tooShort' => 'Username must be at least 3 characters.', 'tooLong' => 'Username cannot be longer than 25 characters.'],
            ['username', 'unique', 'targetClass' => '\app\models\Users', 'targetAttribute' => 'username', 'message' => 'This username is already taken.'],

            //Email Validation
            ['email', 'email', 'message' => 'Enter a valid email address.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\Users', 'targetAttribute' => 'email', 'message' => 'An account with this email already exists.'],

            //Password Validation
            ['password', 'string', 'min' => 8, 'tooShort' => 'Password must be at least 8 characters.'],
            ['password', 'match', 'pattern' => '/[A-Z]/', 'message' => 'Password must contain at least one uppercase letter.'],
            ['password', 'match', 'pattern' => '/[a-z]/', 'message' => 'Password must contain at least one lowercase letter.'],
            ['password', 'match', 'pattern' => '/[0-9]/', 'message' => 'Password must contain at least one number.'],
            ['password', 'match', 'pattern' => '/[\W_]/', 'message' => 'Password must contain at least one special character (e.g., @, #, $).'],

            // Password Confirmation
            ['password_confirmation', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
            [['name'], 'match', 'pattern' => '/^[a-zA-Z\s]+$/', 'message' => 'Only letters and spaces are allowed.'],
        ];

        return [

            [['reCaptcha'], ReCaptchaValidator2::class, 'secret' => Yii::$app->params['recaptchaSecretKey'], 'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    public function uploadProfilePicture()
    {
        if ($this->validate()) {
            $file = UploadedFile::getInstance($this, 'profile_picture');
            if ($file) {
                // Define the file path where the image will be stored
                $fileName = Yii::getAlias('@webroot/uploads/') . uniqid() . '.' . $file->extension;
                // Save the file
                if ($file->saveAs($fileName)) {
                    $this->profile_picture = 'uploads' . basename($fileName); // Save the relative path
                    return true;
                }
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
            'username' => 'Username',
            'contact' => 'Contact',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
            'name' => 'Name',
            'profile_picture' => 'Profile Picture',
            'bio' => 'Bio',
            'created_at' => 'Created At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Handle splitting full name into first and last name
     */


    /**
     * {@inheritdoc}
     */


    // Relations with other models (Articles, Comments, etc.)
    public function getArticles()
    {
        return $this->hasMany(Articles::class, ['created_by' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(Comments::class, ['user_id' => 'id']);
    }

    public function getFollows()
    {
        return $this->hasMany(Follows::class, ['follower_id' => 'id']);
    }

    public function getFollows0()
    {
        return $this->hasMany(Follows::class, ['following_id' => 'id']);
    }

    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }



    //Not there

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function getProfilePictureUrl()
    {
        return Yii::getAlias('web/') . ($this->profile_picture ?: '/images/default.jpg');
    }


}
