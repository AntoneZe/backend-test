<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
    <?php echo Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'category_id',
            [
              // 'attribute' => 'title',
              // 'value' => function () {
              //   var_dump($test);
              //   die;
                // return Product::getSelectedTags($this->id);
              // },
              // static function ($model){
                  // return $model;
              // },
              // 'select2Options' => [
              //     'data' => TemplateSurveyActive::getList(),
              // ],
              // 'headerOptions' => [
              //     'style' => 'width: 190px;',
              // ],
            ],
            'is_published:boolean',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>