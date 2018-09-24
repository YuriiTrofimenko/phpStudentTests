<?php

/**
 * @var $model app\models\forms\ProfileForm
 */

use yii\bootstrap\ActiveForm;
use yiister\adminlte\widgets\Box;
use yii\web\AssetManager;
use yii\web\View;

$this->title = 'Личная информация';
$this->registerJsFile(Yii::$app->assetManager->getPublishedUrl('@app/views/assets') . '/js/profile-form.js');
?>

<div class="row">
    <div class="col-xs-6">
        <?php $form = ActiveForm::begin() ?>
            <div class="box box-primary">
                <div class="box-header with-border"><h4>Личная информация</h4></div>

                <div class="box-body">
                    <?= $form->field($model, 'login')->textInput(['disabled' => true]); ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'oldPassword')->passwordInput() ?>

                    <?= $form->field($model, 'newPassword')->passwordInput() ?>

                    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

                    <?= $form->field($model, 'role')->dropDownList(\app\models\User::roleOptions(), ['disabled' => true]) ?>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-flat btn-primary">Сохранить</button>
                </div>
            </div>
        <?php $form->end() ?>
    </div>
</div>
