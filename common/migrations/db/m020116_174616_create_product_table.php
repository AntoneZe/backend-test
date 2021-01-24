<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m020116_174616_create_product_table extends Migration
{
    private const TABLE = 'product';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'is_published' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->integer()->unsigned(),
            'updated_at' => $this->integer()->unsigned(),
        ]);

        $this->addForeignKey(self::TABLE . '_category_id_fk', self::TABLE, 'category_id',
        'product_category', 'id', 'NO ACTION', 'NO ACTION');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
}