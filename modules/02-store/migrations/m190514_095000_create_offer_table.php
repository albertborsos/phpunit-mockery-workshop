<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer}}`.
 */
class m190514_095000_create_offer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'price' => $this->integer(),
            'discount' => $this->integer(),
            'discount_workdays_period' => $this->integer(),
            'customer_viewed_at' => $this->bigInteger(),
            'status' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer}}');
    }
}
