<?php

use common\models\Product;
use backend\components\View;

/**
 * @var $this View
 * @var $model Product
 */

$this->title = Yii::t('backend', 'Create Product Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ProductCategory-create">

  <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>