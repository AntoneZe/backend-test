<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{

    public $categoryTitle;

    protected function addCondition($query, $attribute, $partialMatch = false)
{
    if (($pos = strrpos($attribute, '.')) !== false) {
        $modelAttribute = substr($attribute, $pos + 1);
    } else {
        $modelAttribute = $attribute;
    }

    $value = $this->$modelAttribute;
    if (trim($value) === '') {
        return;
    }

    $attribute = "product.$attribute";

    if ($partialMatch) {
        $query->andWhere(['like', $attribute, $value]);
    } else {
        $query->andWhere([$attribute => $value]);
    }
}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['created_at', 'updated_at'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['title', 'categoryTitle'], 'safe'],
            [['is_published'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // var_dump( $query->joinWith(['category']));
        // die;

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'title',
                'is_published',
                'created_at',
                'updated_at',
                'categoryTitle' => [
                    'asc' => ['product_category.title' => SORT_ASC],
                    'desc' => ['product_category.title' => SORT_DESC],
                    'label' => 'Category Title'
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['category']);

            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'is_published');

        if ($this->created_at !== null) {
            $query->andFilterWhere(['between', 'created_at', $this->created_at, $this->created_at + 3600 * 24]);
        }

        if ($this->updated_at !== null) {
            $query->andFilterWhere(['between', 'updated_at', $this->updated_at, $this->updated_at + 3600 * 24]);
        }
        
        // $this->addCondition($query, 'created_at');
        // $this->addCondition($query, 'updated_at', true);
        // $this->addCondition($query, 'last_name', true);
        // $this->addCondition($query, 'country_id');

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     // 'category_id' => $this->category_id,
        //     'is_published' => $this->is_published,
        //     'created_at' => $this->created_at,
        //     'updated_at' => $this->updated_at,
        // ]);
        $query->joinWith(['category' => function ($q) {
            var_dump($this->categoryTitle);
            // var_dump($q->where('tbl_category.title LIKE "%' . $this->categoryTitle . '%"'));
            // die;
            $q->andFilterWhere(['like', 'product_category.title', $this->categoryTitle]);
            // $q->where('category.title LIKE "%' . $this->categoryTitle . '%"');
        }]);

        $query->andFilterWhere(['ilike', 'title', $this->title]);

        return $dataProvider;
    }
}