<?php

namespace yii\jquery\input_mask;


class JqueryInputDecimal extends JqueryInputMask
{

    public $integerDigits = '+';

    public $digits = '*';

    public $allowMinus = true;

    public $allowPlus = false;

    public $rightAlign = false;

    public $digitsOptional = true;

    public function init()
    {
        $this->alias = 'decimal';
        parent::init();
    }

    public function run()
    {
        $this->clientOptions = array_merge([
            'rightAlign' => $this->rightAlign,
            'digitsOptional' => $this->digitsOptional
        ], $this->clientOptions, [
            'integerDigits' => $this->integerDigits,
            'digits' => $this->digits,
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus
        ]);
        return parent::run();
    }
}
