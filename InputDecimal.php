<?php

namespace yii\jquery\inputmask;

use NumberFormatter;
use Yii;

class InputDecimal extends InputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $thousandSeparator = null;

    public $decimalSeparator = null;

    public $digits = 2;

    public $digitsOptional = true;

    public $rightAlign = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'decimal';
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->thousandSeparator) || is_null($this->decimalSeparator)) {
            if (preg_match('~^1(\D*)000(\D*)99$~', $formatter->asDecimal(1000.99), $match)) {
                if (is_null($this->thousandSeparator)) {
                    $this->thousandSeparator = $match[1];
                }
                if (is_null($this->decimalSeparator)) {
                    $this->decimalSeparator = $match[2];
                }
            } else {
                if (is_null($this->thousandSeparator)) {
                    $this->thousandSeparator = $formatter->thousandSeparator;
                }
                if (is_null($this->decimalSeparator)) {
                    $this->decimalSeparator = $formatter->decimalSeparator;
                }
            }
            if (is_null($this->thousandSeparator) || is_null($this->decimalSeparator)) {
                if (extension_loaded('intl')) {
                    $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                    if (is_null($this->thousandSeparator)) {
                        $this->thousandSeparator = $numberFormatter->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
                    }
                    if (is_null($this->decimalSeparator)) {
                        $this->decimalSeparator = $numberFormatter->getSymbol(NumberFormatter::DECIMAL_SEPARATOR_SYMBOL);
                    }
                } else {
                    if (is_null($this->thousandSeparator)) {
                        $this->thousandSeparator = ',';
                    }
                    if (is_null($this->decimalSeparator)) {
                        $this->decimalSeparator = '.';
                    }
                }
            }
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->clientOptions = array_merge([
            'digitsOptional' => $this->digitsOptional,
            'rightAlign' => $this->rightAlign
        ], $this->clientOptions, [
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits,
            'groupSeparator' => $this->thousandSeparator,
            'autoGroup' => strlen($this->thousandSeparator) > 0,
            'radixPoint' => $this->decimalSeparator,
            'digits' => $this->digits
        ]);
        return parent::run();
    }
}
