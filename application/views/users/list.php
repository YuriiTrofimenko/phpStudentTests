<?php

/**
 * @var $filter app\models\filters\UsersFilter
 * @var $filterActive bool
 * @var $filterReset string
 */

use app\widgets\Box;
use app\widgets\ButtonList;
use app\widgets\GridView;
use app\widgets\GridFilter;
use app\models\User;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи'];
?>

<h1>Пользователи</h1>

<div class="row">
    <div class="col-xs-12">
            <?php Box::begin([
                'type' => 'primary',
                'header' => ButtonList::widget([
                    'items' => [
                        ['label' => 'Добавить', 'url' => ['users/create'], 'icon' => 'user-plus', 'options' => ['class' => 'btn-flat btn-success']]
                    ]
                ])
            ]) ?>

                <?php $form = GridFilter::begin() ?>
                    <div class="row with-border">
                        <?php if (Yii::$app->user->can('users/filter-role')) { ?>
                            <?= $form->field($filter, 'role')->label('')->widget('app\widgets\ButtonGroup', [
                                'defaultButton' => Yii::$app->user->can('users/browse-role-all'),
                                'items' => array_filter(
                                    User::roleOptions(),
                                    function($text, $role) {
                                        return Yii::$app->user->can('users/browse-role-' . $role);
                                    },
                                ARRAY_FILTER_USE_BOTH),
                                'submitOptions' => [
                                    'class' => 'btn-sm'
                                ]
                            ]) ?>
                        <?php } ?>

                        <?= $form->field($filter, 'login') ?>

                        <?= $form->field($filter, 'email') ?>

                        <?= $form->field($filter, 'activity')->label('')->widget('app\widgets\ButtonGroup', [
                            'items' => [
                                User::STATE_ACTIVE => 'Активные',
                                User::STATE_INACTIVE => 'Неактивные'
                            ],
                            'submitOptions' => [
                                'class' => 'btn-sm'
                            ]
                        ]) ?>

                        <div class="form-group pull-right">
                            <a class="btn btn-flat btn-sm btn-default" href="<?= $filterReset ?>">Сбросить</a>
                        </div>
                    </div>
                <?php $form->end(); ?>

                <div class="box-body">
                    <?= GridView::widget([
                        'dataProvider' => $filter->provider,
                        'columns' => [
                            'login',
                            'email',
                            [
                                'attribute' => 'role',
                                'value' => 'roleText'
                            ],
                            'created',
                            ['class' => 'app\widgets\ActionColumn']
                        ]
                    ]) ?>
                </div>
            <?php Box::end(); ?>
    </div>
</div>


