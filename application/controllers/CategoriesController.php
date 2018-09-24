<?php

namespace app\controllers;

use app\models\filters\CategoriesFilter;
use app\models\forms\CategoryForm;
use app\models\Category;
use yii\helpers\Url;

class CategoriesController extends \app\classes\Controller {
    public $modelClass = 'app\models\Category';

    public function actionIndex() {
        $filter = new CategoriesFilter();
        $filter->load($this->request->get());
        $filterReset = Url::to(['index']);

        return $this->render('list', compact('filter', 'filterReset'));
    }

    public function actionCreate() {
        try {
            $model = new CategoryForm([
                'scenario' => 'create',
                'categoryModel' => new Category(),
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Категория {$model->name} добавлена");
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
            $model = new CategoryForm([
                'scenario' => 'update',
                'categoryModel' => $this->model
            ]);

            if ($this->request->isPost && $model->process($this->request->post())) {
                $this->session->setFlash('success', "Категория {$model->name} сохранена");
                return $this->goBack();
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->render('form', compact('model'));
    }

    public function actionDelete() {
        try {
            if ($this->model->getTests()->exists()) {
                $this->session->setFlash('error', "Нельзя удалить категорию с тестами.");
            } else {
                if ($this->model->delete()) {
                    $this->session->setFlash('success', "Категория {$this->model->name} удалена");
                } else {
                    $this->session->setFlash('error', "Удалить категорию {$this->model->name} не удалось.");
                }
            }
        } catch (\Exception $error) {
            $this->session->setFlash('error', $error->getMessage());
        }

        return $this->goBack();
    }
}