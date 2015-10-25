<?php

namespace yii\jquery\inputmask;

use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use Yii;

class InputMask extends InputWidget
{

    /**
     * @var null|string
     * @see https://github.com/RobinHerbots/jquery.inputmask/blob/3.x/README.md
     */
    public $alias = null;

    /**
     * @var string|array|\yii\web\JsExpression
     * @see https://github.com/RobinHerbots/jquery.inputmask/blob/3.x/README.md
     */
    public $mask = '9*';

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'form-control');
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $inputId = $this->options['id'];
        $hasModel = $this->hasModel();
        if (array_key_exists('value', $this->options)) {
            $value = $this->options['value'];
        } elseif ($hasModel) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }
        $options = array_merge($this->options, ['value' => $value]);
        if ($hasModel) {
            $output = Html::activeTextInput($this->model, $this->attribute, $options);
        } else {
            $output = Html::textInput($this->name, $this->value, $options);
        }
        if (!is_null($this->alias)) {
            $clientOptions = array_merge($this->clientOptions, ['alias' => $this->alias]);
        } else {
            $clientOptions = array_merge($this->clientOptions, ['mask' => $this->mask]);
        }
        if (!array_key_exists('placeholder', $clientOptions) && array_key_exists('placeholder', $options)) {
            $clientOptions['placeholder'] = $options['placeholder'];
        }
        $js = 'jQuery(\'#' . $inputId . '\').inputmask(' . Json::htmlEncode($clientOptions) . ');';
        if (Yii::$app->getRequest()->getIsAjax()) {
            $output .= Html::script($js);
        } else {
            $view = $this->getView();
            InputMaskAsset::register($view);
            $view->registerJs($js);
        }
        return $output;
    }
}
