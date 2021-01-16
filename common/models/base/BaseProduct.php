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
 * @property string $parent_id
 * @property string $name
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property bool $is_published
 * @property int|null $created_at
 * @property int|null $updated_at
 *
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
            [['name', 'content'], 'required'],
            [['parent_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['is_published'], 'boolean'],
            [['name', 'content', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID1'),
            'name' => Yii::t('app', 'name1'),
            'parent_id' => Yii::t('app', 'parent_id1'),
            'content' => Yii::t('app', 'content1'),
            'keywords' => Yii::t('app', 'keywords1'),
            'description' => Yii::t('app', 'description1'),
            'is_published' => Yii::t('app', 'is_published1'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}