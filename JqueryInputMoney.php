<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputMoney extends JqueryInputMask
{

    const ALIAS = 'currency';

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
        if (is_null($this->groupSeparator) || is_null($this->radixPoint)) {
            if (preg_match('~^\d(\D*)\d{3}(\D*)\d{2}$~', $formatter->asDecimal(1000.99), $match)) {
                if (is_null($this->groupSeparator)) {
                    $this->groupSeparator = $match[1];
                }
                if (is_null($this->radixPoint)) {
                    $this->radixPoint = $match[2];
                }
            } else {
                if (is_null($this->groupSeparator)) {
                    $this->groupSeparator = $formatter->thousandSeparator;
                }
                if (is_null($this->radixPoint)) {
                    $this->radixPoint = $formatter->decimalSeparator;
                }
            }
            if (is_null($this->groupSeparator) || is_null($this->radixPoint)) {
                if (extension_loaded('intl')) {
                    $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                    if (is_null($this->groupSeparator)) {
                        $this->groupSeparator = $numberFormatter->getSymbol(NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL);
                    }
                    if (is_null($this->radixPoint)) {
                        $this->radixPoint = $numberFormatter->getSymbol(NumberFormatter::MONETARY_SEPARATOR_SYMBOL);
                    }
                } else {
                    if (is_null($this->groupSeparator)) {
                        $this->groupSeparator = ',';
                    }
                    if (is_null($this->radixPoint)) {
                        $this->radixPoint = '.';
                    }
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
