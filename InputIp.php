<?php

namespace yii\jquery\inputmask;

class InputIp extends InputMask
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'ip';
        parent::init();
    }
}
