<?php

namespace yii3ds\events\models\backend;

use yii3ds\events\Module;
use Yii;

/**
 * Class Event
 * @package yii3ds\events\models\backend
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
     * @var string Jui created date
     */
    private $_created_at;

    /**
     * @var string Jui updated date
     */
    private $_updated_at;

    /**
     * @return string Jui created date
     */
    public function getCreated()
    {
        if (!$this->isNewRecord && $this->_created_at === null) {
            $this->_created_at = Yii::$app->formatter->asDate($this->created_at);
        }
        return $this->_created_at;
    }

    /**
     * Set jui created date
     */
    public function setCreated($value)
    {
        $this->_created_at = $value;
    }

    /**
     * @return string Jui updated date
     */
    public function getUpdated()
    {
        if (!$this->isNewRecord && $this->_updated_at === null) {
            $this->_updated_at = Yii::$app->formatter->asDate($this->updated_at);
        }
        return $this->_updated_at;
    }

    /**
     * Set jui created date
     */
    public function setUpdated($value)
    {
        $this->_updated_at = $value;
    }

    /**
     * @return string Readable event status
     */
    public function getStatus()
    {
        $statuses = self::getStatusArray();

        return $statuses[$this->status_id];
    }

    /**
     * @return array Status array.
     */
    public static function getStatusArray()
    {
        return [
            self::STATUS_UNPUBLISHED => Module::t('events', 'STATUS_UNPUBLISHED'),
            self::STATUS_PUBLISHED => Module::t('events', 'STATUS_PUBLISHED')
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_th', 'title_en', 'detail_th', 'detail_en', 'imageThumb', 'created_at', 'updated_at', 'create_user', 'event_type_id'], 'required'],
            [['detail_th', 'detail_en'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['create_user', 'event_type_id'], 'integer'],
            [['title_th', 'title_en', 'imageThumb'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_th' => 'Title Th',
            'title_en' => 'Title En',
            'detail_th' => 'Detail Th',
            'detail_en' => 'Detail En',
            'imageThumb' => 'Image Thumb',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'create_user' => 'Create User',
            'event_type_id' => 'Event Type ID',
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['admin-create'] = [
            'title_th',
            'title_en',
            'detail_th',
            'detail_en',
            'imageThumb',
            'created_at',
            'updated_at',
        ];
        $scenarios['admin-update'] = [
            'title_th',
            'title_en',
            'detail_th',
            'detail_en',
            'imageThumb',
            'created_at',
            'updated_at',
        ];

        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // print_r($insert);die();
        if (parent::beforeSave($insert)) {
            // if ($this->_created_at) {
            //     $this->created_at = Yii::$app->formatter->asTimestamp($this->_created_at);
            // }
            // if ($this->_updated_at) {
            //     $this->updated_at = Yii::$app->formatter->asTimestamp($this->_updated_at);
            // }
           
                
            return true;
        } else {
            return false;
        }
    }
}
