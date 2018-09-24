<?php

namespace app\models;

class User extends \app\classes\ActiveRecord implements \yii\web\IdentityInterface {
    protected static $tableName = 'users';

    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';

    const STATE_INACTIVE = 0;
    const STATE_ACTIVE = 1;

    public function init() {
        parent::init();

        if ($this->activity === null) {
            $this->activity = self::STATE_ACTIVE;
        }
    }

    public function rules() {
        return [
            'default' => [
                'login' => [
                    'required',
                    ['string', 'max' => 25],
                    'unique'
                ],
                'email' => [
                    'required',
                    ['string', 'max' => 100],
                    'unique',
                    'email'
                ],
                'password' => [
                    'required',
                    ['string', 'length' => 60]
                ],
                'role' => [
                    'required',
                    ['in', 'range' => self::roleKeys()]
                ],
                'activity' => [
                    'required',
                    'boolean'
                ],
                'created' => [
                    'required'
                ]
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'role' => 'Группа',
            'activity' => 'Активный',
            'created' => 'Добавлен'
        ];
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey) {
        return false;
    }

    public function getRoleText() {
        switch ($this->role) {
            case self::ROLE_STUDENT : return 'Студент';
            case self::ROLE_TEACHER : return 'Преподаватель';
            case self::ROLE_ADMIN : return 'Администратор';
        }

        return null;
    }

    public static function roleOptions() {
        return [
            self::ROLE_STUDENT => 'Студент',
            self::ROLE_TEACHER => 'Преподаватель',
            self::ROLE_ADMIN => 'Администратор',
        ];
    }

    public static function roleKeys() {
        return [self::ROLE_STUDENT, self::ROLE_TEACHER, self::ROLE_ADMIN];
    }
}