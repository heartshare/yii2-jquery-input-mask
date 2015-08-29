<?php

namespace yii\jquery\input_mask;


class JqueryInputMoney extends JqueryInputMask
{

    public $prefix = '';

    public $integerDigits = '+';

    public $digits = '*';

    public $allowMinus = true;

    public $allowPlus = false;

public $autoGroup = false;

public $groupSeparator = ' ';

    public $rightAlign = false;

    public $digitsOptional = true;

    public function init()
    {
        $this->alias = 'currency';
        parent::init();
    }

    public function run()
    {
        $this->clientOptions = array_merge([
            'rightAlign' => $this->rightAlign,
            'digitsOptional' => $this->digitsOptional,
'placeholder' => '',
'clearMaskOnLostFocus' => true
        ], $this->clientOptions, [
            'integerDigits' => $this->integerDigits,
            'digits' => $this->digits,
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'autoGroup' => $this->autoGroup,
            'groupSeparator' => $this->groupSeparator,
            'prefix' => $this->prefix
        ]);
        return parent::run();
    }
}
