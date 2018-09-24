<?php

namespace app\models\filters;

use app\models\Test;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class TestsFilter extends \app\classes\Model {
    public $name;
    public $categoryId;
    public $activity;

    public function init() {
        if ($this->activity === null) {
            $this->activity = 1;
        }
    }

    public function rules() {
        return [
            'default' => [
                'name' => [
                    ['string', 'max' => 100, 'tooLong' => 'Максимальная длина строки 100 символов']
                ],
                'categoryId' => [
                    ['exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id', 'message' => 'Такой категории не существует']
                ],
                'activity' => [
                    'boolean'
                ]
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Название',
            'categoryId' => 'Категория'
        ];
    }

    public function getProvider() {
        $this->validate();

        $query = Test::find()->with('category')->joinWith('category');

        if ($this->activity) {
            $query->andWhere(['tests.activity' => 1]);
        } else {
            $query->andWhere(['tests.activity' => 0]);
        }

        if (!$this->getErrors('name')) {
            $query->andFilterWhere(['like', 'tests.name', $this->name]);
        }

        if (!$this->getErrors('categoryId')) {
            $query->andFilterWhere(['categories.id' => $this->categoryId]);
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
                    'categoryId' => [
                        'asc' => ['categories.name' => SORT_ASC],
                        'desc' => ['categories.name' => SORT_DESC]
                    ],
                    'questions',
                    'created'
                ]
            ]
        ]);
    }

    public function getCategoryOptions() {
        return ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
    }
}