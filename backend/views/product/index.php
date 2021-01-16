<?php

use common\enums\GenderEnum;
use common\grid\ActionColumn;
use common\grid\IsPublishedColumn;
use common\models\Product;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use backend\components\View;

/**
 * @var $this View
 * @var $dataProvider ActiveDataProvider
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
                'attribute' => 'gender_id',
                'value' => static function ($model) {
                    /** @var $model Product */
                    return GenderEnum::getValue($model->gender_id);
                }
            ],
            [
                'attribute' => 'price_type_id',
                'value' => 'priceType.title'
            ],
            [
                'attribute' => 'partner_id',
                'value' => 'partner.title'
            ],
            'promo_code',
            'created_at:date',
            'updated_at:date',
            ['class' => IsPublishedColumn::class],
            ['class' => ActionColumn::class],
        ],
    ]); ?>
</div>