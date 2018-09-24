<?php

namespace app\models\filters;

use app\models\Question;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class AnswersFilter extends \app\classes\Model {
    public $text_;

    public function rules() {
        return [
            'default' => [
                'text_' => [
                    ['string', 'max' => 300, 'tooLong' => 'Максимальная длина строки 300 символов']
                ],
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'text_' => 'Текст',
        ];
    }

    public function getProvider() {
        $this->validate();

        $query = Answer::find();

        if (!$this->getErrors('text_')) {
            $query->andFilterWhere(['like', 'question.text_', $this->text_]);
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSizeParam' => false,
                'pageSize' => 10
            ],

        ]);
    }

}