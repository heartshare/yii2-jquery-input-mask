<?php

namespace yii\jquery\inputmask;

use NumberFormatter;
use Yii;

class InputInteger extends InputMask
{

    /**
     * @var bool
     */
    public $allowMinus = true;

    /**
     * @var bool
     */
    public $allowPlus = false;

    public $integerDigits = '+';

    /**
     * @var string|null
     * @see http://www.yiiframework.com/doc-2.0/yii-i18n-formatter.html#$thousandSeparator-detail
     */
    public $groupSeparator = null;

    /**
     * @var bool
     */
    public $rightAlign = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'integer';
        if (is_null($this->groupSeparator)) {
            $formatter = Yii::$app->getFormatter();
            if (preg_match('~^1(\D*)000$~', $formatter->asInteger(1000), $match)) {
                $this->groupSeparator = $match[1];
            } else {
                $this->groupSeparator = $formatter->thousandSeparator;
            }
            if (is_null($this->groupSeparator)) {
                if (extension_loaded('intl')) {
                    $numberFormatter = new NumberFormatter($formatter->locale, NumberFormatter::DECIMAL);
                    $this->groupSeparator = $numberFormatter->getSymbol(NumberFormatter::GROUPING_SEPARATOR_SYMBOL);
                } else {
                    $this->groupSeparator = ',';
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
            'groupSeparator' => $this->groupSeparator,
            'autoGroup' => strlen($this->groupSeparator) > 0
        ]);
        return parent::run();
    }
}
