<?php

namespace app\models;

class Category extends \app\classes\ActiveRecord {
    protected static $tableName = 'categories';

    protected static $activity = false;

    public function rules() {
        return [
            'default' => [
                'name' => [
                    'required',
                    ['string', 'max' => 100],
                    ['unique', 'targetAttribute' => ['name', 'parentId']]
                ],
                'parentId' => [
                    ['exist', 'targetAttribute' => 'id']
                ],
                'created' => [
                    'required'
                ]
            ],
            'safe' => ['name', 'parentId', 'created'],
            /*
            [['name'], 'required'],
            ['name', 'string', 'max' => 100],
            ['name', 'unique', 'targetAttribute' => ['name', 'parentId']],
            */
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'parentId' => 'Родительская категория',
            'created' => 'Добавлена'
        ];
    }

    public function getChildCategories() {
        return self::hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getParent() {
        return self::hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getTests() {
        return self::hasMany(Test::className(), ['categoryId' => 'id']);
    }
}