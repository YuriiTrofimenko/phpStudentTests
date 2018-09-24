<?php

return [
    'dashboard/index' => ['student', 'teacher', 'admin'],
    'profile/index' => ['student', 'teacher', 'admin'],

    'users/index' => ['teacher', 'admin'],
    'users/filter-role' => ['teacher', 'admin'],
    'users/filter-activity' => ['teacher', 'admin'],
    'users/browse-role-all' => ['admin'],
    'users/browse-role-admin' => ['admin'],
    'users/browse-role-teacher' => ['admin', 'teacher'],
    'users/browse-role-student' => ['admin', 'teacher'],
    'users/create' => ['teacher', 'admin'],
    'users/view' => ['teacher', 'admin'],
    'users/update' => ['teacher', 'admin'],
    'users/toggle' => ['admin', 'teacher' => function($id = null) {
        if ($id) {
            $user = \app\models\User::findOne($id);

            return $user && $user->role == \app\models\User::ROLE_STUDENT;
        }

        return true;
    }],
    'users/manage-role' => ['admin'],
    'users/delete' => [],

    'categories/index' => ['teacher', 'admin', 'student'],
    'categories/create' => ['teacher', 'admin'],
    'categories/view' => ['teacher', 'admin'],
    'categories/update' => ['teacher', 'admin'],
    'categories/delete' => [],

    'tests/index' => ['teacher', 'admin', 'student'],
    'tests/create' => ['teacher', 'admin'],
    'tests/toggle' => ['teacher', 'admin'],
    'tests/view' => ['teacher', 'admin'],
    'tests/update' => ['teacher', 'admin'],
    'tests/delete' => [],

    'questions/create' => ['teacher', 'admin'],
    'questions/view' => ['teacher', 'admin'],
    'questions/update' => ['teacher', 'admin'],
    'questions/delete' => ['teacher', 'admin'],

    'answers/create' => ['teacher', 'admin'],
    'answers/update' => ['teacher', 'admin'],
    'answers/delete' => ['teacher', 'admin'],

];