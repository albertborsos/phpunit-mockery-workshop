<?php

namespace tickets\services\ticket\forms;

use app\models\User;
use app\modules\base\components\validators\HtmlPurifierFilter;
use tickets\domains\ticket\Ticket;
use yii\base\Model;

class UpdateTicketForm extends Model
{
    public $id;
    public $name;
    public $description;
    public $assignee_id;
    public $status;

    public function __construct(Ticket $model, array $config = [])
    {
        $this->id = $model->id;
        $this->name = $model->name;
        $this->description = $model->description;
        $this->assignee_id = $model->assignee_id;
        $this->status = $model->status;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'description', 'assignee_id', 'status'], HtmlPurifierFilter::class],
            [['name', 'description', 'assignee_id', 'status'], 'trim'],
            [['name', 'description', 'assignee_id', 'status'], 'default'],
            [['name', 'description', 'assignee_id', 'status'], 'required'],

            [['assignee_id'], 'in', 'range' => array_keys(User::users())],

            [['status'], 'in', 'range' => array_keys(Ticket::allowedStatuses($this->status))],
        ];
    }
}
