<?php

use common\enums\GenderEnum;
use common\models\Gift;
use common\models\GiftCategory;
use common\models\Partner;
use common\models\PriceType;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use backend\components\View;
use yii\widgets\MaskedInput;

/**
 * @var $this View
 * @var $model Product
 */
?>

<div class="Product-form">

  <?php $form = ActiveForm::begin() ?>
  <?php echo $form->field($model, 'title') ?>
  <?php echo $form->field($model, 'promo_code') ?>
  <?php echo $form->field($model, 'category_id')->dropDownList(GiftCategory::getList()) ?>
  <?php echo $form->field($model, 'gender_id')->dropDownList(GenderEnum::$list) ?>
  <?php echo $form->field($model, 'price_type_id')->dropDownList(PriceType::getList()) ?>
  <?php echo $form->field($model, 'partner_id')->dropDownList(Partner::getList()) ?>
  <?php echo $form->field($model, 'price')->widget(MaskedInput::class, [
        'mask' => '9{1,10}.9{2}',
        'options' => [
            'class' => 'form-control',
            'value' => $model->price
        ],
        'clientOptions' => [
            'placeholder' => '0',
        ]
    ]) ?>

  <?php echo $form->field($model, 'is_published')->checkbox() ?>
  <?php echo $this->formSubmit($model->isNewRecord); ?>
  <?php ActiveForm::end() ?>

</div>