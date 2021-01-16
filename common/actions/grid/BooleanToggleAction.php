<?php


namespace common\actions\grid;


use Yii;
use yii\base\Action;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BooleanToggleAction extends Action
{
    public string $modelName;

    public string $attribute;

    public function run(): array
    {
        $req = Yii::$app->request;
        $key = $req->post('key');

        if ($this->attribute === null) {
            $this->attribute = (string)$req->get('attribute');
        }

        $model = $this->findModel($key);
        $model->{$this->attribute} = $model->{$this->attribute} ? false : true;

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->save(false) === false) {
            throw new Exception('Model save error');
        }

        return ['value' => $model->{$this->attribute}];
    }

    public function findModel($key): ActiveRecord
    {
        /** @var $class ActiveRecord */
        $class = $this->modelName;
        $model = $class::findOne($key);

        if ($model === null) {
            throw new NotFoundHttpException('Model not found');
        }

        return $model;
    }
}