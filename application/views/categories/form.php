<?php

/**
 * @var $model app\models\forms\UserForm
 */

use app\widgets\Box;
use kartik\form\ActiveForm;
use yii\bootstrap\Html;


$this->title = $model->scenario == 'create' ? 'Новая категория' : "Редактирование категории";
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => Yii::$app->user->returnUrl];
?>

<div class="row">
    <div class="col-xs-6">
        <?php Box::begin(['header' => $this->title, 'type' => 'primary']) ?>
            <?php $form = ActiveForm::begin([
                'validateOnSubmit' => false
            ]) ?>
                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'parentId')->dropDownList($model->parentOptions, ['prompt' => '']) ?>

                <div class="text-right">
                    <button type="submit" class="btn btn-flat btn-primary">Сохранить</button>
                    <a href="<?= Yii::$app->user->returnUrl ?>" class="btn btn-flat btn-default">Назад</a>
                </div>
            <?php $form->end(); ?>
        <?php Box::end() ?>
    </div>
</div>

