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

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!array_key_exists('url', $this->clientOptions)) {
            $this->clientOptions['url'] = PhoneCodesAsset::register($this->getView())->baseUrl . '/phone-codes.js';
        }
        return parent::run();
    }
}
