<?php

/**
 * @var $model app\models\Test
 */

use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Просмотр теста';
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => Yii::$app->user->returnUrl];
$this->params['breadcrumbs'][] = ['label' => 'просмотр теста'];?>

<h1>Просмотр теста</h1>

<div class="box box-primary">
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'categoryId',
                    'value' => function($model) {
                        return $model->category->id;
                    }
                ],
                'name',
                'description',
                'questions',
                'activity',
                'created'
            ]
        ]) ?>
    </div>

    <div class="box-footer">
        <a href="<?= Yii::$app->user->returnUrl ?>" class="btn btn-flat btn-default pull-left">Назад</a>

        <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-flat btn-primary pull-right">Редактировать</a>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h4>
            Вопросы
            <a href="<?= Url::to(['questions/create', 'testId' => $model->id]) ?>" class="btn btn-flat btn-success pull-right">Добавить</a>
        </h4>
    </div>

    <div class="box-body">
        <?php if (!$model->questionModels) { ?>
            Нет вопросов.
        <?php } else { ?>
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>Вопрос</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($model->questionModels as $question) { ?>
                    <tr>
                        <td><?= $question->text_ ?></td>
                        <td>
                            <a href="<?= Url::to(['questions/view', 'id' => $question->id]) ?>"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="<?= Url::to(['questions/update', 'id' => $question->id]) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="<?= Url::to(['questions/delete', 'id' => $question->id]) ?>"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
