<?php
namespace common\actions\crud;


use yii\base\Action;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class IndexAction extends Action
{
    public $modelName;

    public array $with = [];

    public array $where = [];

    public array $defaultOrder = [
        'id' => SORT_DESC,
    ];

    public function run(): string
    {
        Url::remember();

        /** @var $modelName ActiveRecord */
        $modelName = $this->modelName;

        $query = $modelName::find();
        if($this->with){
            $query->with($this->with);
        }

        if($this->where){
            $query->where($this->where);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $this->defaultOrder,
            ]
        ]);

        return $this->controller->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}