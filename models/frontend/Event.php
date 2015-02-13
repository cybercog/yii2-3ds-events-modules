<?php

namespace yii3ds\events\models\frontend;

use Yii;

/**
 * Class Event
 * @package yii3ds\events\models\frontend
 * Event model.
 *
 * @property integer $id ID
 * @property string $title Title
 * @property string $alias Alias
 * @property string $snippet Intro text
 * @property string $content Content
 * @property integer $views Views
 * @property integer $status_id Status
 * @property integer $created_at Created time
 * @property integer $updated_at Updated time
 */
class Event extends \yii3ds\events\models\Event
{
    /**
     * @var string Created date
     */
    private $_created;

    /**
     * @var string Updated date
     */
    private $_updated;

    /**
     * @return string Created date
     */
    public function getCreated()
    {
        if ($this->_created === null) {
            $this->_created = Yii::$app->formatter->asDate($this->created);
        }
        return $this->_created;
    }

    /**
     * @return string Updated date
     */
    public function getUpdated()
    {
        if ($this->_updated === null) {
            $this->_updated = Yii::$app->formatter->asDate($this->updated);
        }
        return $this->_updated;
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['title_th',
         'title_en',
         'detail_th',
         'detail_en',
         'created_at',
         'updated_at'
        ];
        $scenarios['update'] = ['title_th',
         'title_en',
         'detail_th',
         'detail_en',
         'created_at',
         'updated_at'];

        return $scenarios;
    }

    /**
     * Update views counter.
     *
     * @return boolean Whether views counter was updated or not
     */
    public function updateViews()
    {
        return $this->updateCounters(['views' => 1]);
    }
}
