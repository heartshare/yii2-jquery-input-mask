<?php

namespace yii\jquery\input_mask;

use yii\widgets\MaskedInput;


class JqueryInputMask extends MaskedInput
{

    public $alias = null;

    public function init()
    {
        if (!is_null($this->alias)) {
            $this->clientOptions['alias'] = $this->alias;
        }
        parent::init();
    }
}
