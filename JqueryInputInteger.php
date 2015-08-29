<?php

namespace yii\jquery\input_mask;


class JqueryInputInteger extends JqueryInputMask
{

    public $allowMinus = true;

    public $allowPlus = false;

    public $integerDigits = '+';

    public $rightAlign = false;

    public function init()
    {
        $this->alias = 'integer';
        parent::init();
    }

    public function run()
    {
        $this->clientOptions = array_merge([
            'rightAlign' => $this->rightAlign
        ], $this->clientOptions, [
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus,
            'integerDigits' => $this->integerDigits
        ]);
        return parent::run();
    }
}
