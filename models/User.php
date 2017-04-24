<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public function getAuthKey(){
        
    }

    public function getId() 
    {
        return $this->id;
    }

    public function validateAuthKey($authKey){
        
    }

    public static function findIdentity($id) 
    {
        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        
    }
    
    public function findByEmail($email)
    {
        return User::find()->where(['email'=>$email])->one();
    }        
    
    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;           
    }    

    public function create()
    {
        return $this->save(false);
    }        

}
