<?php

use common\grid\ActionColumn;
use common\grid\IsPublishedColumn;
use common\models\Product;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use backend\components\View;


/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $searchModel backend\models\search\ProductSearch
 */

$this->title = Yii::t('backend', 'Product');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Product-index">

  <p>
    <?php echo Html::a(Yii::t('backend', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'category_id',
                'value' => 'category.title'
            ],
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
            'is_published',
            // ['class' => IsPublishedColumn::class],
            ['class' => ActionColumn::class],
        ],
    ]); ?>
</div>