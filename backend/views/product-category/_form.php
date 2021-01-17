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

<div class="ProductCategory-form">

  <?php $form = ActiveForm::begin() ?>
  <?php echo $form->field($model, 'title') ?>
  <?php echo $form->field($model, 'is_published')->checkbox() ?>
  <?php echo $this->formSubmit($model->isNewRecord); ?>
  <?php ActiveForm::end() ?>

</div>