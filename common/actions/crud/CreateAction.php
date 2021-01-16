<?php

namespace common\actions\crud;


use Yii;
use yii\base\Action;
use yii\db\ActiveRecord;

class CreateAction extends Action
{
    public $modelName;

    public function run()
    {
        $request = Yii::$app->request;

        /** @var $model ActiveRecord */
        $model = new $this->modelName();

        if ($model->load($request->post())) {
            if ($model->save()) {
                return $this->controller->redirect(['index']);
            }
            Yii::warning($model->errors);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}