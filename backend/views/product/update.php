<?php

use common\models\Product;
use backend\components\View;

/**
 * @var $this View
 * @var $model Product
 */

$this->title = Yii::t('backend', 'Update Product') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Update')];
?>
<div class="Product-update">

  <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>