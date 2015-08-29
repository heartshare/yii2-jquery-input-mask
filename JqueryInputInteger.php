<?php

namespace yii\jquery\input_mask;

use Yii;


class JqueryInputInteger extends JqueryInputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $groupSeparator = null;

    public $rightAlign = false;

    public function init()
    {
        $this->alias = 'integer';
        $formatter = Yii::$app->getFormatter();
        if (is_null($this->groupSeparator)) {
            if (preg_match('~^\d(\D*)\d{3}$~', $formatter->asInteger(1000), $match)) {
                $this->groupSeparator = $match[1];
            } else {
                $this->groupSeparator = $formatter->thousandSeparator;
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
            'autoGroup' => (bool)$this->groupSeparator
        ]);
        return parent::run();
    }
}
