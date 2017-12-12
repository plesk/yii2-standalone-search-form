<?php
// Copyright 1999-2017. Plesk International GmbH. All rights reserved.

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
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

<?php Pjax::begin($widget->formPjaxOptions); ?>

    <?php $widget->form = ActiveForm::begin($widget->formOptions); ?>

        <?php
            foreach ($widget->fields as $field) {
                echo $widget->renderField($field);
            }
        ?>

        <div class="form-group">
            <div class="row">
                <div class="<?= $widget->labelHorizontalCssClasses ?>"></div>
                <div class="<?= $widget->buttonsColumnHorizontalCssClasses ?>">
                    <?= $widget->renderButtons(); ?>
                </div>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
