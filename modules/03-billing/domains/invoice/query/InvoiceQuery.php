<?php

namespace billing\domains\invoice\query;

/**
 * This is the ActiveQuery class for [[\billing\domains\invoice\ar\Invoice]].
 *
 * @see \billing\domains\invoice\ar\Invoice
 */
class InvoiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \billing\domains\invoice\ar\Invoice[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \billing\domains\invoice\ar\Invoice|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
