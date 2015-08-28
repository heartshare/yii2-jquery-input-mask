<?php

namespace yii\jquery\input_mask;


class JqueryInputUrl extends JqueryInputMask
{

    public function init()
    {
        $this->alias = 'url';
        parent::init();
    }
}
