<?php

use yii\db\Migration;

class m260121_144955_odoo_external_ids extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand(
            "ALTER TABLE shop_category ADD COLUMN external_id INT NULL UNIQUE;
                ALTER TABLE shop_product ADD COLUMN external_id INT NULL UNIQUE;"
        )->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_category', 'external_id');
        $this->dropColumn('shop_product', 'external_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260121_144955_odoo_external_ids cannot be reverted.\n";

        return false;
    }
    */
}
