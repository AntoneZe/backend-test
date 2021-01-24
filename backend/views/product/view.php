<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tag;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

  <p>
    <?php echo Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
  </p>

  <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'categoryTitle',
            [
              'attribute' => 'productTagList',
              'value' => $selectedTags,
            ],
            'is_published:boolean',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>