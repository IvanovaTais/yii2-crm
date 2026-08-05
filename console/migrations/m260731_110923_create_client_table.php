<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client}}`.
 */
class m260731_110923_create_client_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client}}', [
            'id' => $this->primaryKey(),

            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),

            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string(30),

            'birth_date' => $this->date(),

            'notes' => $this->text(),

            'status' => $this->tinyInteger()->defaultValue(1),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client}}');
    }
}
