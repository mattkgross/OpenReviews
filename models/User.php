<?php

namespace app\models;
use yii\mongodb\Query;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $query = new Query;
        $query->select(['_id','username', 'password'])
            ->from('users')
            ->where(['_id' => $id]);
        $users = $query->all();

        // If a user was returned
        if(count($users) > 0) {
            $users = $users[0];
            $user = array('id'=>$users['_id'],
                'username'=>$users['username'],
                'password'=>$users['password']
            );
            return new static($user);
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $query = new Query;
        $query->select(['_id','username', 'password'])
            ->from('users')
            ->where(['username' => $username]);
        $users = $query->all();

        // If a user was returned
        if(count($users) > 0) {
            $users = $users[0];
            $user = array('id'=>$users['_id'],
                'username'=>$users['username'],
                'password'=>$users['password']
            );
            return new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function createNewUser($username, $password)
    {
        $query = new Query;
        $query->select(['_id','username', 'password'])
            ->from('users')
            ->where(['username' => $username]);
        $users = $query->all();

        // If the username already exists
        if(count($users) > 0) {
            return false;
        }
        else {
            $hashedpass = \Yii::$app->getSecurity()->generatePasswordHash($password);
            $collection = \Yii::$app->mongodb->getCollection('users');
            return $collection->insert(['username' => $username, 'password' => $hashedpass]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
        //return $this->password === $password;
    }
}
