<?php

namespace yii\jquery\inputmask;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class InputMask extends InputWidget
{

    public $alias = null;

    public $mask = null;

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
}
