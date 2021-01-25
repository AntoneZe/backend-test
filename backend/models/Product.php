<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property bool $is_published
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductCategory $category
 * @property ProductTag[] $productTags
 */
class Product extends \yii\db\ActiveRecord
{
    public $productTagsList = [];

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['is_published'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['tags_list'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'fullName' => 'Full Name',
            'category_id' => 'ID категории',
            'categoryTitle' => 'Название категории',
            'productTagList' => 'Список тегов',
            'productTagsList' => 'Список тегов',
            'is_published' => 'Статус публикации',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTitle()
    {
        return $this->category->title;
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('product_tag', ['product_id' => 'id']);
    }

    public function getSelectedTags()
    {
        $selectedIds = $this->getTags()->select('id')->asArray()->all();

        return ArrayHelper::getColumn($selectedIds, 'id');
    }

    public function getProductTagList()
    {
        $selectedIds = $this->getTags()->select('id')->asArray()->all();
        $items = [];

        foreach ($selectedIds as $tagId) {
            $tag = Tag::findOne($tagId);

            $items[] = $tag->title;
        }

        $tagList = implode(', ', $items);

        return $tagList;
    }

    public function getProductTagsList()
    {
        $this->productTagsList = Tag::find();

        return $this->productTagsList;
    }

    public function getTagsList()
    {
        $data = Tag::find()->asArray()->all();
        return ArrayHelper::map($data, 'id', 'title');
    }

    public function saveTags($tags)
    {
        if (is_array($tags)) {
            $this->clearCurrentTags();

            foreach ($tags as $tag_id) {
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);
            }
        }
    }

    public function clearCurrentTags()
    {
        ProductTag::deleteAll(['product_id' => $this->id]);
    }
}