<?php

namespace common\models\base;

use Yii;
use yii\db\ActiveQuery;
use common\db\ActiveRecord;
use common\queries\ProductCategoryQuery;

/**
 * This is the model class for table "gift".
 *
 * @property int $id
 * @property string $title
 * @property bool $is_published
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BaseGift[] $gifts
 */
class BaseProductCategory extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'product_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['is_published'], 'boolean'],
            [['title'], 'string', 'max' => 255],
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
            'is_published' => Yii::t('app', 'Опубликован'),
            'created_at' => Yii::t('app', 'Время создания'),
            'updated_at' => Yii::t('app', 'Время обновления'),
        ];
    }


    /**
     * {@inheritdoc}
     * @return ProductCategoryQuery the active query used by this AR class.
     */
    public static function find(): ProductCategoryQuery
    {
        return new ProductCategoryQuery(static::class);
    }

        /**
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasMany(BaseProduct::class, ['product_id' => 'id']);
    }
}