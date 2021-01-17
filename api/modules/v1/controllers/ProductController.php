<?php


namespace api\modules\v1\controllers;


use api\components\Controller;
use api\modules\v1\resources\Product;
use common\models\search\ProductSearch;
use yii\data\ActiveDataFilter;


class ProductController extends Controller
{
    public $modelClass = Product::class;

    public function actions(): array
    {
        $defaultActions = parent::actions();
        unset($defaultActions['delete'], $defaultActions['update'], $defaultActions['create'], $defaultActions['view']);
        $defaultActions['index']['prepareDataProvider'] = null;
        $defaultActions['index']['dataFilter'] = [
            'class' => ActiveDataFilter::class,
            'searchModel' => ProductSearch::class
        ];

        return $defaultActions;
    }
}