<?php

namespace yii\jquery\inputmask;

use yii\web\AssetBundle;

class PhoneCodesAsset extends AssetBundle
{

    public $sourcePath = '@npm/jquery.inputmask/extra/phone-codes';

    public $depends = ['yii\jquery\inputmask\InputMaskAsset'];
}
