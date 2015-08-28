<?php

namespace yii\jquery\input_mask;


class JqueryInputMac extends JqueryInputMask
{

    public function init()
    {
        $this->mask = '##:##:##:##:##:##'; // $this->alias = 'mac';
        parent::init();
    }
}
