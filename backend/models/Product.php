<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    public $productTagsIds = [];

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
            'title' => 'Title',
            'category_id' => 'Category ID',
            'is_published' => 'Is Published',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->via('productTag');
    }

    public function getTagData()
    {
    $data = Tag::find()->asArray()->all();
    return ArrayHelper::map($data, 'id', 'title');
    }

    public function getTagsIds()
    {
      $this->productTagsIds = ArrayHelper::getColumn(
        $this->getProductTags()->asArray()->all(),
        'tag_id'
      );
      return $this->productTagsIds;
    }

    public function afterSave($insert, $changedAttributes)
 {
   $actualTags = [];
   $tagExists = 0;

   if (($actualTags = ProductTag::find()
	->andWhere("product_id = $this->id")
	->asArray()
	->all()) !== null) {
      $actualTags = ArrayHelper::getColumn($actualTags, 'tag_id');
      $tagExists = 1; 
   }

   if (!empty($this->despIds)) { //save the relations
      foreach ($this->despIds as $id) {
         $actualTags = array_diff($actualTags, [$id]); //remove remaining authors from array
	 $r = new ProductTag();
	 $r->product_id = $this->id;
	 $r->tag_id = $id;
	 $r->save();
	}
   }

   if ($tagExists == 1) { //delete authors tha does not belong anymore to this book
	foreach ($actualTags as $remove) {
	  $r = ProductTag::findOne(['tag_id' => $remove, 'product_id' => $this->id]);
	  $r->delete();
	}
   }

   parent::afterSave($insert, $changedAttributes); //don't forget this
}

}