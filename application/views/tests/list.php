<?php

/**
 * @var $filter app\models\filters\TestsFilter
 * @var $filterReset string
 */

use app\widgets\Box;
use app\widgets\ButtonList;
use app\widgets\GridView;
use app\widgets\GridFilter;

$this->title = 'Тесты';
$this->params['breadcrumbs'][] = ['label' => 'Тесты'];
?>

<h1>Тесты</h1>

<div class="row">
    <div class="col-xs-12">
        <?php Box::begin([
            'type' => 'primary',
            'header' => ButtonList::widget([
                'items' => [
                    ['label' => 'Добавить', 'url' => ['tests/create'], 'options' => ['class' => 'btn-flat btn-success']]
                ]
            ])
        ]) ?>
        <?php $form = GridFilter::begin() ?>
        <div class="row with-border">
            <?= $form->field($filter, 'activity')->label('')->widget('app\widgets\ButtonGroup', [
                'items' => [
                    1 => 'Активные',
                    0 => 'Неактивные'
                ],
                'submitOptions' => [
                    'class' => 'btn-sm'
                ]
            ]) ?>

            <?= $form->field($filter, 'name') ?>

            <?= $form->field($filter, 'categoryId')->dropDownList($filter->categoryOptions, ['prompt' => '']) ?>

            <div class="form-group pull-right">
                <a class="btn btn-flat btn-sm btn-default" href="<?= $filterReset ?>">Сбросить</a>
            </div>
        </div>
        <?php $form->end(); ?>

        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $filter->provider,
                'columns' => [
                    'name',
                    [
                        'attribute' => 'categoryId',
                        'value' => 'category.name'
                    ],
                    'questions',
                    'created',
                    ['class' => 'app\widgets\ActionColumn']
                ]
            ]) ?>
        </div>
        <?php Box::end(); ?>
    </div>
</div>


