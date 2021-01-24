<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;
use trntv\yii\datetime\DateTimeWidget;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
// $this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

  <?php // echo $this->render('_search', ['model' => $searchModel]); 
  ?>

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
        'attribute' => 'Cписок тегов',
        'value' => 'projectTagList',
      ],
      'is_published:boolean',
      [
        'attribute' => 'created_at',
        'format' => 'datetime',
        'filter' => DateTimeWidget::widget([
            'model' => $searchModel,
            'attribute' => 'created_at',
            'phpDatetimeFormat' => 'dd.MM.yyyy',
            'momentDatetimeFormat' => 'DD.MM.YYYY',
            'clientEvents' => [
                'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
            ],
        ])
    ],
    [
      'attribute' => 'updated_at',
      'format' => 'datetime',
      'filter' => DateTimeWidget::widget([
          'model' => $searchModel,
          'attribute' => 'updated_at',
          'phpDatetimeFormat' => 'dd.MM.yyyy',
          'momentDatetimeFormat' => 'DD.MM.YYYY',
          'clientEvents' => [
              'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
          ],
      ])
      ],
      ['class' => 'yii\grid\ActionColumn'],
    ],
  ]); ?>

</div>