<?php

namespace yii\jquery\input_mask;


class JqueryInputDecimal extends JqueryInputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $digits = 2;

    public $digitsOptional = true;

    public $rightAlign = false;

    public function init()
    {
        $this->alias = 'decimal';
        parent::init();
    }

    public function run()
    {
        $this->clientOptions = array_merge([
            'digitsOptional' => $this->digitsOptional,
            'rightAlign' => $this->rightAlign
        ], $this->clientOptions, [
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits,
            'digits' => $this->digits
        ]);
        return parent::run();
    }
}
