<?php

/**
 * @var $model app\models\User
 */

use app\widgets\Box;
use yii\widgets\DetailView;
use app\widgets\ButtonList;

$this->title = 'Просмотр категории';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => Yii::$app->user->returnUrl];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр категории'];
?>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin([
            'type' => 'primary',
            'footer' => ButtonList::widget([
                'items' => [
                    ['label' => 'Назад', 'url' => Yii::$app->user->returnUrl, 'options' => ['class' => 'btn-default']],
                    ['label' => 'Редактировать', 'url' => ['categories/update', 'id' => $model->id], 'options' => ['class' => 'btn-primary']],
                    ['label' => 'Удалить', 'url' => ['categories/delete', 'id' => $model->id], 'options' => ['class' => 'btn-danger', 'data' => ['confirm' => 'Вы уверены?']]]
                ],
                'options' => [
                    'class' => 'text-right'
                ]
            ])
        ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'attribute' => 'parentId',
                        'value' => function ($model) {
                            return $model->parent->name;
                        }
                    ],
                    'created'
                ]
            ]) ?>
        <?php Box::end(); ?>
    </div>
</div>


