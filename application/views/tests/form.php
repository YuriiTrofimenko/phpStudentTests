<?php

/**
 * @var $model app\models\forms\TestForm
 */

use app\widgets\Box;
use kartik\form\ActiveForm;


$this->title = $model->scenario == 'create' ? 'Новый тест' : "Редактирование теста";
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => Yii::$app->user->returnUrl];
?>

<div class="row">
    <div class="col-xs-6">
        <?php Box::begin(['header' => $this->title, 'type' => 'primary']) ?>
            <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'name') ?>

                <?= $form->field($model, 'categoryId')->dropDownList($model->categoryOptions, ['prompt' => '']) ?>

                <?= $form->field($model, 'description')->textarea() ?>

                <?= $form->field($model, 'activity')->widget('kartik\widgets\SwitchInput') ?>

                <div class="text-right">
                    <button type="submit" class="btn btn-flat btn-primary">Сохранить</button>
                    <a href="<?= Yii::$app->user->returnUrl ?>" class="btn btn-flat btn-default">Назад</a>
                </div>
            <?php $form->end(); ?>
        <?php Box::end() ?>
    </div>
</div>

