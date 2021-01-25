<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductCategory */

$this->title = 'Создать категорию продукта';
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>