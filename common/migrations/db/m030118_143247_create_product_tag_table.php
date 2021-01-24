<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_tag}}`.
 */
class m030118_143247_create_product_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_tag}}', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer(),
            'tag_id'=>$this->integer()
        ]);

                $this->createIndex(
                    'tag_product_product_id',
                    'product_tag',
                    'product_id'
                );
        
        
                $this->addForeignKey(
                    'tag_product_product_id',
                    'product_tag',
                    'product_id',
                    'product',
                    'id',
                    'CASCADE'
                );
        
                $this->createIndex(
                    'idx_tag_id',
                    'product_tag',
                    'tag_id'
                );
        
        
                $this->addForeignKey(
                    'fk-tag_id',
                    'product_tag',
                    'tag_id',
                    'tag',
                    'id',
                    'CASCADE'
                );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_tag}}');
    }
}