<?php
// Copyright 1999-2017. Plesk International GmbH. All rights reserved.

namespace plesk\standalonesearchform;

use yii\web\AssetBundle as YiiAssetBundle;


class AssetBundle extends YiiAssetBundle
{
    public $sourcePath = '@vendor/plesk/yii2-standalone-search-form/assets';
    public $css = [
        'standalone-search-form.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\widgets\PjaxAsset',
    ];
}
