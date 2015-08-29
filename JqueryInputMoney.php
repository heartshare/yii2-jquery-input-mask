<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputMoney extends JqueryInputMask
{

    const ALIAS = 'currency';

    public $currency = null;

    public $prefix = null;

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $groupSeparator = null;

    public $radixPoint = null;

    public $digits = 2;

    public $digitsOptional = true;

    public $rightAlign = false;

    public $suffix = null;

    public function init()
    {
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->currency)) {
            $this->currency = $formatter->currencyCode;
        }
        if (is_null($this->prefix) || is_null($this->suffix)) {
            if (($this->currency !== false) && preg_match('~^(\D*)1\D*000\D*99(\D*)$~', $formatter->asCurrency(1000.99, $this->currency), $match)) {
                if (is_null($this->prefix)) {
                    $this->prefix = $match[1];
                }
                if (is_null($this->suffix)) {
                    $this->suffix = $match[2];
                }
            } else {
                if (is_null($this->prefix)) {
                    $this->prefix = '';
                }
                if (is_null($this->suffix)) {
                    $this->suffix = '';
                }
            }
        }
        if (is_null($this->groupSeparator) || is_null($this->radixPoint)) {
            if (preg_match('~^1(\D*)000(\D*)99$~', $formatter->asDecimal(1000.99), $match)) {
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
            'prefix' => $this->prefix,
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits,
            'groupSeparator' => $this->groupSeparator,
            'autoGroup' => strlen($this->groupSeparator) > 0,
            'radixPoint' => $this->radixPoint,
            'digits' => $this->digits,
            'suffix' => $this->suffix
        ]);
        return parent::run();
    }
}
