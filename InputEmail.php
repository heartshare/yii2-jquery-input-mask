<?php

namespace yii\jquery\inputmask;

class InputEmail extends InputMask
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'email';
        parent::init();
    }
}
