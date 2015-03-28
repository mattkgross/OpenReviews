<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class SignUpForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'confirm_password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // password is validated by validatePassword()
            ['confirm_password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            // Passwords are not identical
            if(strcmp($this->password, $this->confirm_password) !== 0) {
                $this->addError($attribute, 'Passwords do not match.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function signup()
    {
        if ($this->validate()) {
            // Create the user
            if(User::createNewUser($this->username, $this->password)) {
                // Log them in
                $result = Yii::$app->user->login($this->getUser(), 0);

                if($result) {
                    \Yii::$app->getSession()->setFlash('success', 'Welcome to Open Reviews, '.$this->username.'.');
                } else {
                    \Yii::$app->getSession()->setFlash('error', 'Something went wrong.');
                }

                return $result;
            }
            return false;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false or is_null($this->_user)) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
