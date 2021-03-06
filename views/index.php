<?php
// Copyright 2017. Plesk International GmbH.

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use plesk\standalonesearchform\AssetBundle;
use plesk\standalonesearchform\SearchForm;

/* @var $this \yii\web\View */

AssetBundle::register($this);

/** @var SearchForm $widget */
$widget = $this->context;

$this->registerJs(
    '$("#' . Html::encode($widget->formPjaxOptions['id']) . '").on("pjax:success", function() {
        $.pjax.reload(' . Json::encode(Yii::$app->pjax->pjaxConvertConfigWidgetToJs($widget->resultAreaPjaxOptions)) . ');
    });'
);
?>

<?php if ($widget->reloadFormWithPjax) {
    Pjax::begin($widget->formPjaxOptions);
} ?>
    <?php $widget->form = ActiveForm::begin($widget->formOptions); ?>

        <?= $widget->renderFields() ?>

        <div class="row form-group">
            <div class="col">
                <?= $widget->renderButtons(); ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
<?php
    if (!$widget->reloadFormWithPjax) {
        Pjax::begin($widget->formPjaxOptions);
    }
    Pjax::end();
?>
