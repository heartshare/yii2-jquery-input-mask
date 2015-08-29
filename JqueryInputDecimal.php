<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputDecimal extends JqueryInputMask
{

    const ALIAS = 'decimal';

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $groupSeparator = null;

    public $radixPoint = null;

    public $digits = 2;

    public $digitsOptional = true;

    public $rightAlign = false;

    public function init()
    {
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->radixPoint)) {
            if (preg_match('~^\d\D*\d{3}(\D*)\d{2}$~', $formatter->asDecimal(1000.99), $match)) {
                $this->radixPoint = $match[1];
            } else {
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
            'groupSeparator' => $this->groupSeparator,
            'autoGroup' => strlen($this->groupSeparator) > 0,
            'radixPoint' => $this->radixPoint,
            'digits' => $this->digits
        ]);
        return parent::run();
    }
}
