<?php

namespace app\controllers;

use app\models\filters\TestsFilter;
use app\models\forms\TestForm;
use app\models\Test;
use yii\helpers\Url;

class TestsController extends \app\classes\Controller {
    public $modelClass = 'app\models\Test';

    public function actionIndex() {
        $filter = new TestsFilter();
        $filter->load($this->request->get());
        $filterReset = Url::to(['index']);

        return $this->render('list', compact('filter', 'filterReset'));
    }

    public function actionCreate() {
        try {
            $model = new TestForm([
                'scenario' => 'create',
                'testModel' => new Test(),
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Тест {$model->name} добавлен");
                return $this->goBack();
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

    public function actionUpdate() {
        try {
            $model = new TestForm([
                'scenario' => 'update',
                'testModel' => $this->model
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Тест {$model->name} сохранен");
                return $this->goBack();
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }

    public function actionToggle() {
        try {
            if (!$this->model->toggle()->save()) {
                throw new \Exception('Can not toggle test');
            }

            $this->session->setFlash('success', "Состояние теста {$this->model->name} изменено");
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->goBack();
    }

    public function actionDelete() {
        try {
            if ($this->model->delete()) {
                $this->session->setFlash('success', "Категория {$this->model->name} удалена");
            } else {
                $this->session->setFlash('error', "Удалить категорию {$this->model->name} не удалось.");
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->goBack();
    }
}