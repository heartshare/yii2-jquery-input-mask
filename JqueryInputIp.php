<?php

namespace yii\jquery\input_mask;


class JqueryInputIp extends JqueryInputMask
{

    public function init()
    {
        $this->alias = 'ip';
        parent::init();
    }
}
