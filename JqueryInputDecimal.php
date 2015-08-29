<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputDecimal extends JqueryInputInteger
{

    const ALIAS = 'decimal';

    public $radixPoint = null;

    public $digits = 2;

    public $digitsOptional = true;

    public function init()
    {
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->radixPoint)) {
            if (preg_match('~^\d\D*\d{3}(\D*)\d{2}$~', $formatter->asDecimal(1000.99), $match)) {
                $this->radixPoint = $match[1];
            } else {
                $this->radixPoint = $formatter->decimalSeparator;
            }
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
            'digitsOptional' => $this->digitsOptional
        ], $this->clientOptions, [
            'radixPoint' => $this->radixPoint,
            'digits' => $this->digits
        ]);
        return parent::run();
    }
}
