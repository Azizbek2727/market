<?php

use yii\db\Migration;

class m260118_125159_offline_sales extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand("CREATE TABLE offline_sale (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    telegram_user_id BIGINT NOT NULL,
    product_id INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    currency VARCHAR(3) DEFAULT 'UZS',
    created_at INT NOT NULL,
    INDEX (telegram_user_id),
    INDEX (product_id)
);
")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('offline_sale');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260118_125159_offline_sales cannot be reverted.\n";

        return false;
    }
    */
}
