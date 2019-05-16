<?php

namespace tickets\domains\ticket\query;

/**
 * This is the ActiveQuery class for [[\tickets\domains\ticket\ar\Ticket]].
 *
 * @see \tickets\domains\ticket\ar\Ticket
 */
class TicketQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \tickets\domains\ticket\ar\Ticket[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \tickets\domains\ticket\ar\Ticket|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
