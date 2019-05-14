<?php

namespace store\domains\offer\query;

/**
 * This is the ActiveQuery class for [[\store\domains\offer\ar\Offer]].
 *
 * @see \store\domains\offer\ar\Offer
 */
class OfferQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \store\domains\offer\ar\Offer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \store\domains\offer\ar\Offer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
