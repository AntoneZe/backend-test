<?php

namespace common\controllers;


use common\actions\crud\CreateAction;
use common\actions\crud\DeleteAction;
use common\actions\crud\IndexAction;
use common\actions\crud\UpdateAction;
use common\actions\grid\BooleanToggleAction;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

abstract class CrudController extends Controller
{
    public string $modelName;

    public array $with = [];

    public array $where = [];

    public function actions(): array
    {
        $actions = [];

        $indexDefaultOrder = [
            'id' => SORT_ASC,
        ];

        $actions['index'] = [
            'class' => IndexAction::class,
            'modelName' => $this->modelName,
            'defaultOrder' => $indexDefaultOrder,
            'with' => $this->with,
            'where' => $this->where
        ];

        $actions = ArrayHelper::merge($actions, [
            'create' => [
                'class' => CreateAction::class,
                'modelName' => $this->modelName,
            ],
            'update' => [
                'class' => UpdateAction::class,
                'modelName' => $this->modelName,
                'with' => $this->with,
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelName' => $this->modelName,
            ],
            'toggle-is-published' => [
                'class' => BooleanToggleAction::class,
                'modelName' => $this->modelName,
                'attribute' => 'is_published',
            ],
            'boolean-toggle' => [
                'class' => BooleanToggleAction::class,
                'modelName' => $this->modelName,
            ]
        ]);

        return $actions;
    }
}