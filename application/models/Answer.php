<?php

namespace app\models;

class Answer extends \app\classes\ActiveRecord {

    protected static $tableName = 'answers';

    protected static $timestamp = false;

    protected static $activity = false;

    public function rules() {
        return [
            'default' => [
                'questionId' =>[
                    'required',
                    'integer',
                    ['exist','targetClass' => Question::className(),'targetAttribute' => 'id']
                ],
                'text_' =>[
                    'required',
                    ['string', 'max'=>300],
                ],
                'isTrue' =>[
                    'required',
                    ['boolean', 'trueValue' => 1]
                ]
            ]
           /* [['questionId','isTrue','text_'], 'required'],
            ['text_', 'string', 'max' => 300],
            ['isTrue', 'boolean', 'trueValue' => 1],
            ['questionId', 'integer'],
            ['questionId', 'exist', 'targetClass' => Question::className(), 'targetAttribute' => 'id']*/
        ];
    }

    public function attributeLabels() {
        return [
            'questionId' => 'Вопрос',
            'text_' => 'Ответ',
            'isTrue' => 'Правильность'
        ];
    }

    public function getQuestion() {
        return self::hasOne('app\models\Question', ['id' => 'questionId']);
    }
}