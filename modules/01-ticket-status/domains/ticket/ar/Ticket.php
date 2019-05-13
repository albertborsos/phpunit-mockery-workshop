<?php

namespace tickets\domains\ticket\ar;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $owner_id
 * @property int $assignee_id
 * @property int $status
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['owner_id', 'assignee_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'owner_id' => 'Owner ID',
            'assignee_id' => 'Assignee ID',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \tickets\domains\ticket\query\TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \tickets\domains\ticket\query\TicketQuery(get_called_class());
    }
}
