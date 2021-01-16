<?php

namespace common\actions\crud;


use Yii;
use yii\base\Action;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DeleteAction extends Action
{
    public $modelName;

    public function run($id = null): Response
    {
        $request = Yii::$app->request;

        $selectedRows = $request->post('selectedRows');

        if ($selectedRows) {
            foreach ($selectedRows as $rowId) {
                $this->delete($rowId);
            }
        } else {
            $this->delete($id);
        }

        return $this->controller->redirect(['index']);
    }

    public function delete($id): void
    {
        $model = $this->findModel($id);

        if (!$model->delete()) {
            Yii::warning($model->errors);
        }
    }

    public function findModel($id): ActiveRecord
    {
        /** @var $class ActiveRecord */
        $class = $this->modelName;
        $model = $class::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException("Model $id not found");
        }

        return $model;
    }
}