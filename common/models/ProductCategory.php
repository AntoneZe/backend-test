<?php

namespace common\models;


use common\enums\PublishEnum;
use common\models\base\BaseProductCategory;
use Intervention\Image\Exception\NotFoundException;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class ProductCategory extends BaseProductCategory
{

}