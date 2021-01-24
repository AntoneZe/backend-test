<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\ProductCategory;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-form">

  <?php $form = ActiveForm::begin(); ?>

  <?php echo $form->errorSummary($model); ?>

  <?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

  <?php echo $form->field($model, 'category_id')->dropDownList(ProductCategory::find()->asArray()->select(['title'])->indexBy('id')->column()) ?>

  <?php echo $form->field($model, 'is_published')->checkbox() ?>



  <?php 
  // var_dump($model->tagsList);
  // var_dump($selectedTags);
?>

  <?= $form->field($model, 'productTagsIdList')->widget(Select2::className(), [
   'data'=> $model->tagsList,
   'options' => ['multiple' => true, 'value' => $selectedTags]
  ]);?>

  <?php echo $form->field($model, 'created_at')->textInput() ?>

  <?php echo $form->field($model, 'updated_at')->textInput() ?>

  <div class="form-group">
    <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>