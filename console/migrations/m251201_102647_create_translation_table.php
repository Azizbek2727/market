<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translation}}`.
 */
class m251201_102647_create_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translation}}', [
            'id'        => $this->primaryKey(),
            'modelName' => $this->string(150)->notNull(),
            'itemId'    => $this->integer()->notNull(),
            'lang'      => $this->string(16)->notNull(),
            'attribute' => $this->string(150)->notNull(),
            'value'     => $this->text()->null(),
        ]);

        // Unique index for quick upsert & lookup
        $this->createIndex(
            'idx_translation_unique',
            '{{%translation}}',
            ['modelName','itemId','lang','attribute'],
            true
        );

        // Indexes to speed queries
        $this->createIndex('idx_translation_model_lang', '{{%translation}}', ['modelName','lang']);
        $this->createIndex('idx_translation_item', '{{%translation}}', ['itemId']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%translation}}');
    }
}
