<?php

namespace app\controllers;

use app\models\Answer;
use app\models\forms\QuestionForm;
use app\models\Question;

class QuestionsController extends \app\classes\Controller {
    public $modelClass = 'app\models\Question';

    /*
    public function actionIndex() {
        $filter = new QuestionsFilter();
        $filter->load($this->request->get());
        $filterReset = Url::to(['index']);

        return $this->render('list', compact('filter', 'filterReset'));
    }
    */

    public function actionCreate($testId) {
        try {
            $model = new QuestionForm([
                'scenario' => 'create',
                'questionModel' => new Question([
                    'testId' => $testId
                ]),
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Вопрос добавлен");
                return $this->redirect(['tests/view', 'id' => $testId]);
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }

    public function actionUpdate() {
        try {
            $model = new QuestionForm([
                'scenario' => 'update',
                'questionModel' => $this->model
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Вопрос сохранен");
                return $this->redirect(['tests/view', 'id' => $this->model->testId]);
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }

    public function actionView() {
        $model = $this->model;

        return $this->render('details', compact('model'));
    }
    

    public function actionDelete() { //удаление вопроса должно быть вместе с удалением ответов? T_T
        $transaction = $this->db->beginTransaction();

        try {
            //Answer::deleteAll(['questionId' => $this->model->id]);

            if ($this->model->delete()) {
                $this->model->test->questions--;
                $this->model->test->save();
                $this->session->setFlash('success', "Вопрос удалён");
            } else {
                throw new \Exception("Удалить вопрос не удалось.");
            }

            $transaction->commit();
        } catch (\Exception $error) {
            $transaction->rollback();
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->redirect(['tests/view', 'id' => $this->model->testId]);
    }
}