<?php

namespace yii\jquery\input_mask;


class JqueryInputInteger extends JqueryInputMask
{

    public $integerDigits = '+';

    public $allowMinus = true;

    public $allowPlus = false;

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
            'integerDigits' => $this->integerDigits,
            'allowMinus' => $this->allowMinus,
            'allowPlus' => $this->allowPlus
        ]);
        return parent::run();
    }
}
