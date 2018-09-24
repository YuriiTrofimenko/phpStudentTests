<?php

namespace app\models\filters;

use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CategoriesFilter extends \app\classes\Model {
    public $name;
    public $parentId;

    public function rules() {
        return [
            'default' => [
                'name' => [
                    ['string', 'max' => 100, 'tooLong' => 'Максимальная длина строки 100 символов']
                ],
                'parentId' => [
                    ['exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id', 'message' => 'Такой категории не существует']
                ]
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'parentId' => 'Родительская категория'
        ];
    }

    public function getProvider() {
        $this->validate();

        $query = Category::find()->with('parent')->joinWith('parent as parents');

        if (!$this->getErrors('name')) {
            $query->andFilterWhere(['like', 'categories.name', $this->name]);
        }

        if (!$this->getErrors('parentId')) {
            $query->andFilterWhere(['categories.parentId' => $this->parentId]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeParam' => false,
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC
                ],
                'attributes' => [
                    'name',
                    'parentId' => [
                        'asc' => ['parents.name' => SORT_ASC],
                        'desc' => ['parents.name' => SORT_DESC]
                    ],
                    'created'
                ]
            ]
        ]);
    }

    public function getParentOptions() {
        return ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
    }
}