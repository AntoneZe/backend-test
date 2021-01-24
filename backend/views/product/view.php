<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tag;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

  <p>
    <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?php echo Html::a('Set Tags', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
  </p>

  <?php 
  // var_dump($selectedTags); die;
  ?>

  <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'category_id',
            [
              'attribute' => 'Tag list',
              'value' => function($model) {
                $items = [];

                foreach ($model->selectedTags as $tagId) {
                    $tag = Tag::findOne($tagId);
        
                    $items[] = $tag->title;
                }
        
                $tag_list = implode(', ', $items);
        
                return $tag_list;
                
              },
            ],
            'is_published:boolean',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>