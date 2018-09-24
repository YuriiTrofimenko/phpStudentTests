<?php

/**
 * @var $model app\models\forms\AnswerForm
 */

use kartik\form\ActiveForm;
use yii\helpers\Url;


$this->title = $model->scenario == 'create' ? 'Добавление ответа' : "Редактирование ответа";
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => Yii::$app->user->returnUrl];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр теста', 'url' => ['tests/view', 'id' => $model->answerModel->question->testId]];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр вопроса', 'url' => ['questions/view', 'id' => $model->answerModel->questionId]];
?>

<div class="row">
    <div class="col-xs-6">
        <div class="box box-primary">
            <?php $form = ActiveForm::begin() ?>
                <div class="box-header with-border"><h4><?= $this->title ?></h4></div>

                <div class="box-body">
                    <?= $form->field($model, 'text_') ?>

                    <?= $form->field($model, 'isTrue')->widget('\kartik\switchinput\SwitchInput', [
                        'pluginOptions' => [
                            'onText' => '<i class="glyphicon glyphicon-check"></i>',
                            'offText' => '<i class="glyphicon glyphicon-remove"></i>',
                        ]
                    ]) ?>
                </div>

                <div class="box-footer">
                    <a href="<?= Url::to(['tests/view', 'id' => $model->answerModel->questionId]) ?>" class="btn btn-flat btn-default pull-left">Назад</a>
                    <button type="submit" class="btn btn-flat btn-primary pull-right">Сохранить</button>
                </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>

