<?php

namespace app\models\forms;

use app\models\Category;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class CategoryForm extends \app\classes\Model {
    public $name;
    public $parentId;

    private $_category;

    public function rules() {
        return [
            'create' => [
                'name' => [
                    ['required', 'message' => 'Введите название категории'],
                    ['string', 'length' => [3, 100], 'tooShort' => 'Строка не может быть меньше 3 символов', 'tooLong' => 'Строка не может быть больше 100 символов'],
                    ['unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId']]
                ],
                'parentId' => [
                    ['exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id']
                ]
            ],
            'update' => [
                'name' => [
                    ['required', 'message' => 'Введите название категории'],
                    ['string', 'length' => [3, 100], 'tooShort' => 'Строка не может быть меньше 3 символов', 'tooLong' => 'Строка не может быть больше 100 символов'],
                    ['unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId'], 'filter' => ['!=', 'id', $this->_category->id]]
                ],
                'parentId' => [
                    ['exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id']
                ]
            ]

            /*
            ['name', 'required', 'on' => ['create', 'update']],
            ['name', 'string', 'max' => 100, 'on' => ['create', 'update']],
            ['parentId', 'integer'],
            ['parentId', 'exist', 'targetClass' => 'app\models\Category', 'targetAttribute' => 'id', 'on' => ['create', 'update']],
            ['name', 'unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId'], 'on' => ['create']],

            ['name', 'unique', 'targetClass' => 'app\models\Category', 'targetAttribute' => ['name', 'parentId'],
                'on' => ['update'], 'filter' => ['!=', 'id', $this->id]
            ],

            ['id', 'required', 'on' => ['update']],
            ['id', 'integer', 'on' => ['update']],
            ['id', 'exist', 'targetClass' => 'app\models\Category', 'on' => ['update']],
            ['parentId', 'compare', 'compareAttribute' => 'id', 'operator' => '!=', 'on' => ['update']],
            */
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'parentId' => 'Родительская категория',
        ];
    }

    public function setCategoryModel($model) {
        if (!$model instanceof \app\models\Category) {
            throw new InvalidConfigException('Model must be an instance of app\models\Category');
        }

        $this->_category = $model;
        $this->name = $model->name;
        $this->parentId = $model->parentId;
    }

    public function getCategoryModel() {
        return $this->_category;
    }

    /*
    public function onProccessCreate() {

    }

    public function onProccessUpdate() {

    }
    */

    public function onProcess() {
        $this->_category->name = $this->name;
        $this->_category->parentId = $this->parentId;

        if (!$this->_category->save(false)) {
            throw new \Exception($this->scenario == 'create' ? 'Не удалось добавить категорию' : 'Не удалось сохранить категорию');
        }

        return true;
    }

    public function getParentOptions() {
        $query = Category::find()->asArray();

        if ($this->scenario == 'update') {
            $query->andWhere(['!=', 'id', $this->_category->id]);
        }

        return ArrayHelper::map($query->all(), 'id', 'name');
    }
}