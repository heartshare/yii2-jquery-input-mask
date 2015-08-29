<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputDecimal extends JqueryInputMask
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
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->radixPoint)) {
            $this->radixPoint = $formatter->decimalSeparator;
        }
        if (is_null($this->radixPoint)) {
            if (extension_loaded('intl')) {
                $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                $this->radixPoint = $numberFormatter->getSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
            } else {
                $this->radixPoint = '.';
            }
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
