<?php

use yii\db\Migration;

class m260127_110449_extend_offline_sale extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand("
        ALTER TABLE offline_sale
    ADD COLUMN odoo_partner_id INT NULL,
    ADD COLUMN odoo_order_id   INT NULL,
    ADD COLUMN odoo_picking_id INT NULL,
    ADD COLUMN odoo_synced     TINYINT(1) DEFAULT 0,
    ADD COLUMN sync_error      TEXT NULL;
    ADD COLUMN synced_at INT NULL;
")->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('offline_sale', 'odoo_partner_id');
        $this->dropColumn('offline_sale', 'odoo_order_id');
        $this->dropColumn('offline_sale', 'odoo_picking_id');
        $this->dropColumn('offline_sale', 'odoo_synced');
        $this->dropColumn('offline_sale', 'sync_error');
        $this->dropColumn('offline_sale', 'synced_at');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260127_110449_extend_offline_sale cannot be reverted.\n";

        return false;
    }
    */
}
