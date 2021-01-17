<?php

use common\grid\ActionColumn;
use common\grid\IsPublishedColumn;
use common\models\ProductCategory;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use backend\components\View;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Product Category');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

  <p>
    <?php echo Html::a(Yii::t('backend', 'Create Product Category'), ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
          'id',
          'title',
          'created_at:date',
          'updated_at:date',
          // ['class' => IsPublishedColumn::class],
          ['class' => ActionColumn::class],
      ],
    ]); ?>
</div>