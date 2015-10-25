<?php

namespace yii\jquery\inputmask;

use NumberFormatter;
use Yii;

class InputInteger extends InputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $thousandSeparator = null;

    public $rightAlign = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'integer';
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->thousandSeparator)) {
            if (preg_match('~^1(\D*)000$~', $formatter->asInteger(1000), $match)) {
                $this->thousandSeparator = $match[1];
            } else {
                $this->thousandSeparator = $formatter->thousandSeparator;
            }
            if (is_null($this->thousandSeparator)) {
                if (extension_loaded('intl')) {
                    $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                    $this->thousandSeparator = $numberFormatter->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
                } else {
                    $this->thousandSeparator = ',';
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
            'rightAlign' => $this->rightAlign
        ], $this->clientOptions, [
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits,
            'groupSeparator' => $this->thousandSeparator,
            'autoGroup' => strlen($this->thousandSeparator) > 0
        ]);
        return parent::run();
    }
}
