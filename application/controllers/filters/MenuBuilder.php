<?php

namespace app\controllers\filters;

class MenuBuilder extends \yii\base\ActionFilter {
    public function beforeAction($action) {
        $menu = [];
        $user = \Yii::$app->user;

        if ($user->can('dashboard/index')) {
            $menu[] = ['label' => 'Главная', 'url' => ['dashboard/index'], 'icon' => 'home'];
        }

        if ($user->can('tests/index')) {
            $menu[] = ['label' => 'Тесты', 'url' => ['tests/index'], 'icon' => 'navicon'];
        }

        if ($user->can('categories/index')) {
            $menu[] = ['label' => 'Категории', 'url' => ['categories/index'], 'icon' => 'navicon'];
        }

        if ($user->can('users/index')) {
            $menu[] = ['label' => 'Пользователи', 'url' => ['users/index'], 'icon' => 'users'];
        }

        \Yii::$app->view->params['menu'] = $menu;

        return true;
    }
}