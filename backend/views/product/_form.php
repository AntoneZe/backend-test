<?php

use common\models\Gift;
use common\models\ProductCategory;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use backend\components\View;

/**
 * @var $this View
 * @var $model Product
 */
?>

<div class="Product-form">

  <?php $form = ActiveForm::begin() ?>
  <?php echo $form->field($model, 'title') ?>
  <?php echo $form->field($model, 'category_id')->dropDownList(ProductCategory::getList()) ?>
  <?php echo $form->field($model, 'is_published')->checkbox() ?>
  <?php echo $this->formSubmit($model->isNewRecord); ?>
  <?php ActiveForm::end() ?>

</div>