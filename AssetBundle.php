<?php
// Copyright 2017. Plesk International GmbH.

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
        'yii\bootstrap4\BootstrapAsset',
        'yii\widgets\PjaxAsset',
    ];
}
