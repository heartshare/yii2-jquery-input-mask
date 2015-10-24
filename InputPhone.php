<?php

namespace yii\jquery\inputmask;

class InputPhone extends InputMask
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->alias = 'phone';
        parent::init();
    }
}
