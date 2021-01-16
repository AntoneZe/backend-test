<?php

namespace common\actions\crud;


use Yii;
use yii\base\Action;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class UpdateAction extends Action
{
    public $modelName;

    public array $with = [];

    public function run($id)
    {
        $request = Yii::$app->request;

        $model = $this->findModel($id);

        if ($model->load($request->post())) {
            if ($model->save()) {
                if ($request->post('saveAndClose')) {
                    return $this->controller->redirect(['index']);
                }
            } else {
                Yii::warning($model->errors);
            }
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }

    public function findModel($id): ActiveRecord
    {
        /** @var $class ActiveRecord */
        $class = $this->modelName;
        $query = $class::find();

        if ($this->with) {
            $query->with($this->with);
        }

        $model = $query->where(['id' => $id])->one();

        if ($model === null) {
            throw new NotFoundHttpException("Model $id not found");
        }

        return $model;
    }
}