<?php

namespace yii\jquery\input_mask;

use Yii;


class JqueryInputMoney extends JqueryInputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $radixPoint = null;

    public $digits = 2;

    public $digitsOptional = true;

    public $rightAlign = false;

    public function init()
    {
        $this->alias = 'decimal';
        if (is_null($this->radixPoint)) {
            $this->radixPoint = Yii::$app->getFormatter()->decimalSeparator;
        }
        if (is_null($this->radixPoint)) {
            $this->radixPoint = '.';
        }
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
            'radixPoint' => $this->radixPoint,
            'digits' => $this->digits
        ]);
        return parent::run();
    }
}
