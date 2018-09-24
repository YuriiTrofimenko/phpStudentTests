<?php

namespace app\widgets;

use app\classes\Url;
use rmrevin\yii\fontawesome\component\Icon;
use yii\helpers\Html;

class ActivityColumn extends DataColumn {
    public $attribute = 'activity';
    public $activeState = 1;
    public $inactiveState = 0;
    public $controller;
    public $format = 'html';

    public function getDataCellValue($model, $key, $index) {
        $value = parent::getDataCellValue($model, $key, $index);
        $icon = $value == $this->activeState ? 'check-square-o' : 'square-o';

        $permission = $this->controller ? $this->controller . '/manage-activity' : Url::normalizeRoute('manage-activity');
        if (\Yii::$app->user->can($permission, ['id' => $key])) {
            $url = [$this->controller ? $this->controller . '/manage-activity' : Url::normalizeRoute('manage-activity'), 'id' => $key];

            return Html::a(new Icon($icon), $url);
        } else {
            return new Icon($icon);
        }
    }
}