<?php
// Copyright 1999-2017. Plesk International GmbH. All rights reserved.

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
<?= $form->field($model, $attributeName, ['options' => ['class' => 'form-group']])->begin() ?>
    <div class="row">
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
    </div>
<?= $form->field($model, $attributeName)->end() ?>
