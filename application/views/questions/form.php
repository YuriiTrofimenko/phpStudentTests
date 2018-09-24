<?php

/**
 * @var $model app\models\forms\QuestionForm
 */

use kartik\form\ActiveForm;
use yii\helpers\Url;


$this->title = $model->scenario == 'create' ? 'Добавление вопроса' : "Редактирование вопроса";
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => Yii::$app->user->returnUrl];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр теста', 'url' => ['tests/view', 'id' => $model->questionModel->testId]];
?>

<div class="row">
    <div class="col-xs-6">
        <div class="box box-primary">
            <?php $form = ActiveForm::begin() ?>
                <div class="box-header with-border"><h4><?= $this->title ?></h4></div>

                <div class="box-body">
                    <?= $form->field($model, 'text_') ?>
                </div>

                <div class="box-footer">
                    <a href="<?= Url::to(['tests/view', 'id' => $model->questionModel->testId]) ?>" class="btn btn-flat btn-default pull-left">Назад</a>
                    <button type="submit" class="btn btn-flat btn-primary pull-right">Сохранить</button>
                </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>

