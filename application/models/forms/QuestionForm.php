<?php

namespace app\models\forms;

use app\models\Test;
use yii\helpers\ArrayHelper;

class QuestionForm extends \app\classes\Model  //в этом классе нет метода save() - сохранение происходит в другом месте?
{
    public $text_;

    public function rules() {  //нужны лиздесь сценарии?
        return [
            'create' => [
                'text_' => [
                    'required',
                    ['string', 'max' => 300]
                ]
            ],
            'update' => [
                'text_' => [
                    'required',
                    ['string', 'max' => 300]
                ]
            ]
        ];
    }

    public function attributeLabels() {
        return [
            'testId' => 'Тест',
            'text_' => 'Вопрос',
        ];
    }

    public function getParentOptions() {
        $query = Test::find();

        return ArrayHelper::map($query->all(), 'id', 'name');
    }

    private $_question;

    public function setQuestionModel($question) {
        $this->_question = $question;
        $this->text_ = $question->text_;
    }

    public function getQuestionModel() {
        return $this->_question;
    }

    public function onProcess() {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $this->_question->text_ = $this->text_;

            if (!$this->_question->save(false)) {
                throw new \Exception('Can not save question');
            }

            if ($this->scenario == 'create') {
                $tihs->_question->test->questions++;

                if (!$this->_question->test->save(false)) {
                    throw new \Exception('Can not save test');
                }
            }

            $transaction->commit();
            return true;
        } catch (\Exception $error) {
            $transaction->rollback();

            throw $error;
        }
    }

}