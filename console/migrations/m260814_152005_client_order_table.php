<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_order}}`.
 */
class m260814_152005_client_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_order}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'order_date' => $this->dateTime()->notNull(),
            'total_amount' => $this->decimal(10, 2)->notNull(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // Add foreign key for table `client`
        $this->addForeignKey(
            'fk-client_order-client_id',
            '{{%client_order}}',
            'client_id',
            '{{%client}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-client_order-client_id',
            '{{%client_order}}'
        );

        $this->dropTable('{{%client_order}}');
    }

}
