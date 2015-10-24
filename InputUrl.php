<?php

namespace yii\jquery\inputmask;

class InputUrl extends InputMask
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'url';
        parent::init();
    }
}
