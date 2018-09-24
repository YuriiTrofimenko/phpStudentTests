<?php

namespace app\models\forms;

use app\models\Test;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AnswerForm extends \app\classes\Model  //в этом классе нет метода save() - сохранение происходит в другом месте?
{
    public $text_;
    public $isTrue;

    public function rules() {  //нужны лиздесь сценарии?
        return [
            'create' => [
                'text_' => [
                    'required',
                    ['string', 'max' => 300]
                ],
                'isTrue' => [
                    'required',
                    'boolean',
                ]
            ],
            'update' => [
                'text_' => [
                    'required',
                    ['string', 'max' => 300]
                ],
                'isTrue' => [
                    'required',
                    'boolean',
                ],
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'text_' => 'Ответ',
            'isTrue' => 'Правильность',

        ];
    }

    private $_answer;

    public function setAnswerModel($answer) {
        $this->_answer = $answer;
        $this->text_ = $answer->text_;
        $this->isTrue = $answer->isTrue;
    }

    public function getAnswerModel() {
        return $this->_answer;
    }

    public function onProcess() {
        $this->_answer->text_ = $this->text_;
        $this->_answer->isTrue = $this->isTrue;

        if (!$this->_answer->save(false)) {
            throw new \Exception('Can not save answer');
        }

        return true;
    }

}