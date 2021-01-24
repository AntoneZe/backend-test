<?php

use common\models\User;
use app\models\Tag;
use app\models\Product;
use app\models\ProductCategory;
use yii\db\Migration;

class m150725_192740_seed_data extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'webmaster',
            'email' => 'webmaster@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        
        $this->insert('{{%user}}', [
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('manager'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user}}', [
            'username' => 'user',
            'email' => 'user@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        
        $this->insert('{{%tag}}', [
            'title' => 'Tag 1',
        ]);
        
        $this->insert('{{%tag}}', [
            'title' => 'Tag 2',
        ]);

        $this->insert('{{%tag}}', [
            'title' => 'Tag 3',
        ]);

        $this->insert('{{%product_category}}', [
            'title' => 'Product category 1',
        ]);
        
        $this->insert('{{%product_category}}', [
            'title' => 'Product category 2',
        ]);

        $this->insert('{{%product_category}}', [
            'title' => 'Product category 3',
        ]);

        $this->insert('{{%product}}', [
            'title' => 'Product 1',
            'category_id' => 1,
        ]);
        
        $this->insert('{{%product}}', [
            'title' => 'Product 2',
            'category_id' => 2,
        ]);

        $this->insert('{{%product}}', [
            'title' => 'Product 3',
            'category_id' => 3,
        ]);

        $this->insert('{{%product_tag}}', [
            'product_id' => 1,
            'tag_id' => 1,
        ]);
        
        $this->insert('{{%product_tag}}', [
            'product_id' => 2,
            'tag_id' => 2,
        ]);

        $this->insert('{{%product_tag}}', [
            'product_id' => 3,
            'tag_id' => 3,
        ]);        
        
        $this->insert('{{%product_tag}}', [
            'product_id' => 3,
            'tag_id' => 2,
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 1,
            'locale' => Yii::$app->sourceLanguage,
            'firstname' => 'webmaster',
            'lastname' => ''
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 2,
            'locale' => Yii::$app->sourceLanguage
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id' => 3,
            'locale' => Yii::$app->sourceLanguage
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.theme-skin',
            'value' => 'skin-blue',
            'comment' => 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-fixed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-boxed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-collapsed-sidebar',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 'disabled',
            'comment' => 'Set it to "enabled" to turn on maintenance mode'
        ]);

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance'
        ]);

        $this->delete('{{%key_storage_item}}', [
            'key' => [
                'backend.theme-skin',
                'backend.layout-fixed',
                'backend.layout-boxed',
                'backend.layout-collapsed-sidebar',
            ],
        ]);

        $this->delete('{{%user_profile}}', [
            'user_id' => [1, 2, 3]
        ]);
        
        $this->delete('{{%tag}}', [
            'tag_id' => [1, 2, 3]
        ]);

        $this->delete('{{%product_category}}', [
            'product_category_id' => [1, 2, 3]
        ]);

        $this->delete('{{%product}}', [
            'product_id' => [1, 2, 3]
        ]);       
        
        $this->delete('{{%product_tag}}', [
            'product_tag_id' => [1, 2, 3, 4]
        ]);

        $this->delete('{{%user}}', [
            'id' => [1, 2, 3]
        ]);
    }
}