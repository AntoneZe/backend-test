<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tag */

$this->title = 'Обновить тег: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-update">

  <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>