<?php

use yii\db\Migration;

class m251203_151213_i18n_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Source messages (original English strings)
        $this->createTable('{{%i18n_source}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(255)->notNull(),
            'message' => $this->text()->notNull(),
        ]);

        // Translated messages
        $this->createTable('{{%i18n_message}}', [
            'id' => $this->integer()->notNull(),
            'language' => $this->string(16)->notNull(),
            'translation' => $this->text(),
        ]);

        $this->addPrimaryKey('pk_i18n_message', '{{%i18n_message}}', ['id', 'language']);

        $this->addForeignKey(
            'fk_i18n_message_source',
            '{{%i18n_message}}',
            'id',
            '{{%i18n_source}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%i18n_message}}');
        $this->dropTable('{{%i18n_source}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251203_151213_i18n_db cannot be reverted.\n";

        return false;
    }
    */
}
