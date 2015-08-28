<?php

namespace yii\jquery\input_mask;


class JqueryInputEmail extends JqueryInputMask
{

    public function init()
    {
        $this->alias = 'email';
        parent::init();
    }
}
