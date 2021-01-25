<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категория проодукта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">


    <p>
        <?php echo Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'is_published:boolean',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>