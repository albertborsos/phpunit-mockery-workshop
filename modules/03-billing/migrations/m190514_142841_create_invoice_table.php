<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice}}`.
 */
class m190514_142841_create_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice}}', [
            'id' => $this->primaryKey(),
            'related_invoice_id' => $this->integer(),
            'offer_id' => $this->integer(),
            'serial_number' => $this->string(),
            'type' => $this->string(),
            'amount' => $this->integer(),
            'item' => $this->string(),
            'comment' => $this->string(),
        ]);

        $this->addForeignKey('fk_offer', '{{%invoice}}', 'offer_id', '{{%offer}}', 'id');
        $this->addForeignKey('fk_related_invoice', '{{%invoice}}', 'related_invoice_id', '{{%invoice}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_offer', '{{%invoice}}');
        $this->dropForeignKey('fk_related_invoice', '{{%invoice}}');
        $this->dropTable('{{%invoice}}');
    }
}
