<?php

namespace app\controllers;

use app\models\Answer;
use app\models\forms\AnswerForm;

class AnswersController extends \app\classes\Controller {
    public $modelClass = 'app\models\Answer';

    /*
    public function actionIndex() {
        $filter = new AnswersFilter(); //запилить
        $filter->load($this->request->get());
        $filterReset = Url::to(['index']);

        return $this->render('list', compact('filter', 'filterReset'));
    }
    */

    public function actionCreate($questionId) {
        $model = new AnswerForm([
            'scenario' => 'create',
            'answerModel' => new Answer([
                'questionId' => $questionId
            ]),
        ]);

        try {
            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Ответ добавлен");
                return $this->redirect(['questions/view', 'id' => $questionId]);
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }

    public function actionUpdate() {
        try {
            $model = new AnswerForm([
                'scenario' => 'update',
                'answerModel' => $this->model
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Ответ сохранен");
                return $this->redirect(['questions/view', 'id' => $this->model->question->id]);
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }


    public function actionDelete() {
        try {
            if ($this->model->delete()) {
                $this->session->setFlash('success', "Ответ удалён");
            } else {
                $this->session->setFlash('error', "Удалить ответ не удалось.");
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->redirect(['questions/view', 'id' => $this->model->questionId]);
    }
}