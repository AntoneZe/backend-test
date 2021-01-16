<?php

use common\models\Product;
use backend\components\View;

/**
 * @var $this View
 * @var $model Product
 */

$this->title = Yii::t('backend', 'Create Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Product-create">

  <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>