<?php

namespace yii3ds\events;

use yii\base\BootstrapInterface;

/**
 * Events module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {

        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                'POST <_m:events>' => '<_m>/events/create',
                '<_m:events>' => '<_m>/default/index',
                '<_m:events>/<id:\d+>-<alias:[a-zA-Z0-9_-]{1,100}+>' => '<_m>/default/view',
            ]
        );
        // Add module I18N category.
        if (!isset($app->i18n->translations['yii3ds/events']) && !isset($app->i18n->translations['yii3ds/*'])) {
            $app->i18n->translations['yii3ds/events'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@yii3ds/events/messages',
                'forceTranslation' => true,
                'fileMap' => [
                    'yii3ds/events' => 'events.php',
                ]
            ];
        }
    }
}
