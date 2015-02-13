<?php

namespace yii3ds\events\models;

use vova07\users\traits\ModuleTrait;
use yii\db\ActiveQuery;

/**
 * Class EventQuery
 * @package yii3ds\event\models
 */
class EventQuery extends ActiveQuery
{
    use ModuleTrait;

    /**
     * Select published posts.
     *
     * @return $this
     */
    public function published()
    {
        // $this->andWhere(['status_id' => Event::STATUS_PUBLISHED]);

        return $this;
    }

    /**
     * Select unpublished posts.
     *
     * @return $this
     */
    public function unpublished()
    {
        // $this->andWhere(['status_id' => Event::STATUS_UNPUBLISHED]);

        return $this;
    }
}
