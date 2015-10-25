<?php

namespace yii\jquery\inputmask;

class InputMac extends InputMask
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'mac';
        parent::init();
    }
}
