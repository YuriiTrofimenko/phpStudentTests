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

$this->title = 'Категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории'];
?>

<h1>Категории</h1>

<div class="row">
    <div class="col-xs-12">
            <?php Box::begin([
                'type' => 'primary',
                'header' => ButtonList::widget([
                    'items' => [
                        ['label' => 'Добавить', 'url' => ['categories/create'], 'options' => ['class' => 'btn-flat btn-success']]
                    ]
                ])
            ]) ?>
                <?php $form = GridFilter::begin() ?>
                    <div class="row with-border">
                        <?= $form->field($filter, 'name') ?>

                        <?= $form->field($filter, 'parentId')->dropDownList($filter->parentOptions, ['prompt' => '']) ?>

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
                                'attribute' => 'parentId',
                                'value' => 'parent.name'
                            ],
                            'created',
                            ['class' => 'app\widgets\ActionColumn']
                        ]
                    ]) ?>
                </div>
            <?php Box::end(); ?>
    </div>
</div>


