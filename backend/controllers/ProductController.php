<?php


namespace backend\controllers;


use common\controllers\CrudController;
use common\models\Product;

class ProductController extends CrudController
{
    public string $modelName = Product::class;
}