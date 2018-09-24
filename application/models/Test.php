<?php

namespace app\models;

class Test extends \app\classes\ActiveRecord {

    protected static $tableName='tests';

    public function rules() {
        return [
            'default' => [
                'name' =>[
                    'required',
                    ['string', 'max' => 100],
                    ['unique', 'targetAttribute' => ['name', 'categoryId']]
                ],
                'description' =>[
                    'required',
                    ['string', 'max' => 300],
                ],
                'categoryId' =>[
                    'required',
                    'integer',
                    ['exist', 'targetClass' => Category::className(), 'targetAttribute' => 'id'],
                ],
                'questions' =>[
                    'integer',
                ],
                'activity' => [
                    'required',
                    'boolean'
                ]
            ]
        ]; 
            
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'categoryId' => 'Родительская категория',
            'questions' => 'Количество вопросов',
            'description' => 'Описание',
            'created' => 'Добавлен',
            'activity' => 'Активность'
        ];
    }

    public function getCategory() {
        return self::hasOne('app\models\Category', ['id' => 'categoryId']);
    }

    public function getQuestionModels() {
        return self::hasMany(Question::className(), ['testId' => 'id']);
    }
}