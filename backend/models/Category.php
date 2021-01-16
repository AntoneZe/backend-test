<?php

namespace backend\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord {
  
  public static function tableName() {
    return 'category';
  }

  public function getProducts() {
    return $this->hasMany(Product::class, ['category_id' => 'id']);
  }

  public function getParent() {
    return $this->hasOne(self::class, ['id' => 'parent_id']);
  }

  public function getChildren() {
    return $this->hasMany(self::class, ['parent_id' => 'id']);
  }
  
}