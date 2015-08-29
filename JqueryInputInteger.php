<?php

namespace yii\jquery\input_mask;

use NumberFormatter,
    Yii;


class JqueryInputInteger extends JqueryInputMask
{

    const ALIAS = 'integer';

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $groupSeparator = null;

    public $rightAlign = false;

    public function init()
    {
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
        parent::init();
    }

    public function run()
    {
        $this->clientOptions = array_merge([
            'rightAlign' => $this->rightAlign
        ], $this->clientOptions, [
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits,
            'groupSeparator' => $this->groupSeparator,
            'autoGroup' => strlen($this->groupSeparator) > 0
        ]);
        return parent::run();
    }
}
