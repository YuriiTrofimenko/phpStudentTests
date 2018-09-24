<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Url;

class GridFilter extends \kartik\form\ActiveForm {
    public $method = 'get';

    public $type = 'inline';

    public $fieldConfig = [
        'autoPlaceholder' => false,
        'showLabels' => true,
        'options' => [
            'class' => 'form-group form-group-sm'
        ]
    ];

    public $enableClientValidation = false;
    public $options = [
        'class' => 'filter'
    ];

    public function run()
    {
        $content = ob_get_clean();
        echo $this->beginForm($this->action, $this->method, $this->options);
        echo $content;

        if ($this->enableClientScript) {
            $this->registerClientScript();
        }

        echo Html::endForm();
    }

    protected function beginForm($action, $method, $options) {
        $options['action'] = Url::to($action);
        $options['method'] = $method;

        return Html::beginTag('form', $options);
    }
}