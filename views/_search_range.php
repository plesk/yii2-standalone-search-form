<?php
// Copyright 2017. Plesk International GmbH.

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model yii\base\Model */
/* @var $attributeName string */
/* @var $form yii\widgets\ActiveForm */
/* @var $inputFrom string */
/* @var $inputTo string */
/* @var $labelHorizontalCssClasses string */
/* @var $fieldHorizontalCssClasses string */

?>
<?= $form->field($model, $attributeName, ['options' => ['class' => 'row form-group']])->begin() ?>
    <?= Html::activeLabel($model,$attributeName, ['class' => "control-label $labelHorizontalCssClasses"]) ?>
    <div class="<?= $fieldHorizontalCssClasses ?>">
        <div>
            <?= Html::activeLabel($model,"{$attributeName}From", ['class' => 'control-label sr-only']) ?>
            <?= $inputFrom ?>
        </div>
        <div>
            <?= Html::error($model,"{$attributeName}From", ['class' => 'help-block']) ?>
        </div>
    </div>
    <div class="<?= $fieldHorizontalCssClasses ?>">
        <div>
            <?= Html::activeLabel($model,"{$attributeName}To", ['class' => 'control-label sr-only']) ?>
            <?= $inputTo ?>
        </div>
        <div>
            <?= Html::error($model,"{$attributeName}To", ['class' => 'help-block']) ?>
        </div>
    </div>
<?= $form->field($model, $attributeName)->end() ?>
