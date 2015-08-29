<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputMoney extends JqueryInputMask
{

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
        $this->alias = 'currency';
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->groupSeparator)) {
            if (preg_match('~^\d(\D*)\d{3}$~', $formatter->asInteger(1000), $match)) {
                $this->groupSeparator = $match[1];
            } else {
                $this->groupSeparator = $formatter->thousandSeparator;
            }
        }
        if (is_null($this->groupSeparator)) {
            if (extension_loaded('intl')) {
                $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                $this->groupSeparator = $numberFormatter->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
            } else {
                $this->groupSeparator = ',';
            }
        }
        if (is_null($this->radixPoint)) {
            if (preg_match('~^\d(\D*)\d{3}(\D*)\d{2}$~', $formatter->asDecimal(1000.99), $match)) {
                $this->radixPoint = $match[2];
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
