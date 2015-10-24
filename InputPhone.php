<?php

namespace yii\jquery\inputmask;

class InputPhone extends InputMask
{

    const ALIAS = 'phone';

    public function run()
    {
        $this->clientOptions['url'] = 'http://rawgit.com/RobinHerbots/jquery.inputmask/3.x/extra/phone-codes/phone-codes.js';
        return parent::run();
    }
}