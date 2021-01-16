<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m210116_074616_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'content' => $this->string()->notNull(),
            'keywords' => $this->text(),
            'description' => $this->text(),
            'is_published' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}