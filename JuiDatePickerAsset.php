<?php

namespace rsiripong\juidatepicker;

use yii\web\AssetBundle;


class JuiDatePickerAsset extends AssetBundle
{
    public $sourcePath = '@rsiripong/juidatepicker/assets';
    public $depends = ['yii\jui\JuiAsset'];
    public function init() {
        //$this->css[] = YII_DEBUG ? 'css/bootstrap-datepicker3.css' : 'css/bootstrap-datepicker3.min.css';
        //$this->js[] = YII_DEBUG ? 'js/juidatepicker.js' : 'js/juidatepicker.js';
    }
}
