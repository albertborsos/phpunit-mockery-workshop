<?php

namespace tickets\services\ticket\forms;

use app\models\User;
use app\modules\base\components\validators\HtmlPurifierFilter;
use tickets\domains\ticket\Ticket;
use yii\base\Model;

class CreateTicketForm extends Model
{
    public $name;
    public $description;
    public $assignee_id;
    public $status;

    public function rules()
    {
        return [
            [['name', 'description', 'assignee_id', 'status'], HtmlPurifierFilter::class],
            [['name', 'description', 'assignee_id', 'status'], 'trim'],
            [['name', 'description', 'assignee_id', 'status'], 'default'],
            [['name', 'description', 'assignee_id', 'status'], 'required'],

            [['assignee_id'], 'in', 'range' => array_keys(User::users())],

            [['status'], 'in', 'range' => array_keys(Ticket::allowedStatuses($this->status))], // @todo exercise: update validator
        ];
    }
}
