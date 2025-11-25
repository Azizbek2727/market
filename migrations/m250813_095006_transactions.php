<?php

use yii\db\Migration;

class m250813_095006_transactions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'phone', $this->string(32));

        $this->createTable('transactions', [
            'id' => $this->primaryKey(),
            'transaction_id' => $this->string(64),
            'octo_uuid' => $this->string(64),
            'order_id' => $this->integer(),
            'sum' => $this->integer(),
            'currency' => $this->string(10),
            'description' => $this->string(128),
            'status' => $this->string(64),

            'signature' => $this->string(128),
            'hash_key' => $this->string(128),
            'total_sum' => $this->decimal(),
            'transfer_sum' => $this->decimal(),
            'refunded_sum' => $this->decimal(),
            'card_country' => $this->string(),
            'maskedPan' => $this->string(64),
            'rrn' => $this->string(64),
            'payed_time' => $this->string(64),
            'card_type' => $this->string(64),
            'is_physical_card' => $this->string(64),



            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);

        $this->addForeignKey('transactions-order', 'transactions', 'order_id', 'order', 'id');
        $this->addForeignKey('transactions-creator', 'transactions', 'created_by', 'user', 'id');
        $this->addForeignKey('transactions-updated', 'transactions', 'updated_by', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transactions');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250813_095006_transactions cannot be reverted.\n";

        return false;
    }
    */
}
