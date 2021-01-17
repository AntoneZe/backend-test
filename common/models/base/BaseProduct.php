<?php

namespace common\models\base;

use Yii;
use yii\db\ActiveQuery;
use common\db\ActiveRecord;
use common\queries\ProductQuery;

/**
 * This is the model class for table "gift".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property bool $is_published
 * 
 * @property BaseProductCategory $category
 */
class BaseProduct extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['is_published'], 'boolean'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseProductCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'category_id' => Yii::t('app', 'Category ID'),
            'is_published' => Yii::t('app', 'Опубликован'),
            'created_at' => Yii::t('app', 'Время создания'),
            'updated_at' => Yii::t('app', 'Время обновления'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find(): ProductQuery
    {
        return new ProductQuery(static::class);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(BaseProductCategory::class, ['id' => 'category_id']);
    }
}