<?php

/**
 * @var $model app\models\Question
 */

use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Просмотр вопроса';
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => Yii::$app->user->returnUrl];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр теста', 'url' => ['tests/view', 'id' => $model->testId]];
?>

<h1>Просмотр вопроса</h1>

<div class="box box-primary">
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'testId',
                    'value' => function($model) {
                        return $model->test->name;
                    }
                ],
                'text_',
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
            Ответы
            <a href="<?= Url::to(['answers/create', 'questionId' => $model->id]) ?>" class="btn btn-flat btn-success pull-right">Добавить</a>
        </h4>
    </div>

    <div class="box-body">
        <?php if (!$model->answers) { ?>
            Нет ответов.
        <?php } else { ?>
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th>Ответ</th>
                    <th>Правильный</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($model->answers as $answer) { ?>
                    <tr>
                        <td><?= $answer->text_ ?></td>
                        <td><?php if ($answer->isTrue) { ?><i class="glyphicon glyphicon-check"></i><? } ?></td>
                        <td>
                            <a href="<?= Url::to(['answers/update', 'id' => $answer->id]) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="<?= Url::to(['answers/delete', 'id' => $answer->id]) ?>"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>
