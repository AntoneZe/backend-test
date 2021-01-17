<?php

use common\models\Product;
use backend\components\View;

/**
 * @var $this View
 * @var $model ProductCategory
 */

$this->title = Yii::t('backend', 'Update Product Category') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Update')];
?>
<div class="ProductCategory-update">

  <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>