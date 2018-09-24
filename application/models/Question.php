<?php

namespace app\models;

class Question extends \app\classes\ActiveRecord {

    protected static $tableName = 'questions';

    protected static $timestamp = false;

    protected static $activity = false;
    
    public function rules() {
        return [
            'default' =>[
                'testId' =>[
                    'required',
                    'integer',
                    ['exist', 'targetClass' => Test::className(), 'targetAttribute' => 'id'],
                ],
                'text_' =>[
                    'required',
                    ['string', 'max' => 300]
                ]
            ]
            /*[['testId','text_'], 'required'],
            ['text_', 'string', 'max' => 300],
            ['testId', 'integer'],
            ['testId', 'exist', 'targetClass' => Test::className(), 'targetAttribute' => 'id']*/
        ];
    }

    public function attributeLabels() {
        return [
            'testId' => 'Тест',
            'text_' => 'Вопрос',
            'created' => 'Добавлен',
        ];
    }

    public function getTest() {
        return self::hasOne('app\models\Test', ['id' => 'testId']);
    }

    public function getAnswers() {
        return $this->hasMany(Answer::className(), ['questionId' => 'id']);
    }

    public function getTrueAnswers() {
        return $this->hasMany(Answer::className(), ['questionId' => 'id'])
            ->where(['isTrue' => 1]);
    }
}
