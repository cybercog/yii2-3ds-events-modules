<?php

namespace yii3ds\events\models;

use yii3ds\base\behaviors\PurifierBehavior;
use yii3ds\events\Module;
use yii3ds\events\traits\ModuleTrait;
use vova07\fileapi\behaviors\UploadBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Event
 * @package yii3ds\events\models
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
class Event extends ActiveRecord
{
    use ModuleTrait;

    /** Unpublished status **/
    const STATUS_UNPUBLISHED = 0;
    /** Published status **/
    const STATUS_PUBLISHED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
            
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    
                    'imageThumb' => [
                        'path' => $this->module->imagePath,
                        'tempPath' => $this->module->imagesTempPath,
                        'url' => $this->module->imageUrl
                    ]
                ]
            ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // return [
        //     // Required
        //     [['title', 'content'], 'required'],
        //     // Trim
        //     [['title', 'snippet', 'content'], 'trim'],
        //     // Status
        //     [
        //         'status_id',
        //         'default',
        //         'value' => $this->module->moderation ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
        //     ]
        // ];
        return [
            // Required
            [['title_th', 'title_en', 'detail_th', 'detail_en'], 'required'],
            // Trim
            [['title_th', 'title_en', 'detail_th', 'detail_en'], 'trim'],
            // Status
            // [
            //     'status_id',
            //     'default',
            //     'value' => $this->module->moderation ? self::STATUS_PUBLISHED : self::STATUS_UNPUBLISHED
            // ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => Module::t('events', 'ATTR_ID'),
            // 'title' => Module::t('events', 'ATTR_TITLE'),
            
            // 'created_at' => Module::t('events', 'ATTR_CREATED'),
            // 'updated_at' => Module::t('events', 'ATTR_UPDATED'),
        ];
    }
}
