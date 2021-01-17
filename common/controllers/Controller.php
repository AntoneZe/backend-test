<?php

use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\rest\CreateAction;
use yii\rest\ViewAction;
use yii\rest\IndexAction;
use yii\rest\UpdateAction;
use yii\web\Response;

class Controller extends \yii\rest\Controller
{
    public $modelClass;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::class,
        ];

        return $behaviors;
    }

    public function verbs(): array
    {
        return [
            'create' => ['POST'],
            'update' => ['PUT'],
            'index' => ['GET'],
            'view' => ['GET'],
        ];
    }

    public function actions(): array
    {
        return [
            'update' => [
                'class' => UpdateAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => $this->modelClass,
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
        ];
    }

    public function prepareDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->active()
        ]);
    }

}