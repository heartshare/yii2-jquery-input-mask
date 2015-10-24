<?php

namespace yii\jquery\inputmask;

use yii\widgets\MaskedInput;

class JqueryInputMask extends MaskedInput
{

    const MASK = null; // abstract

    const ALIAS = null; // abstract

    public $alias = null;

    public function init()
    {
        if (!is_null(self::MASK)) {
            $this->mask = self::MASK;
        }
        if (!is_null(self::ALIAS)) {
            $this->alias = self::ALIAS;
        }
        if (!is_null($this->alias)) {
            $this->clientOptions['alias'] = $this->alias;
        }
        parent::init();
    }
}
