<?php

namespace yii\jquery\inputmask;

use yii\web\AssetBundle;

class InputMaskAsset extends AssetBundle
{

    public $sourcePath = '@npm/jquery.inputmask/dist';

    public $depends = ['yii\web\JqueryAsset'];

    public $js = ['jquery.inputmask.bundle.js'];
}
