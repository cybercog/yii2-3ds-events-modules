Yii2-Start events module.
========================
This module provide a events managing system for Yii2-Start application.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii3ds/yii2-start-events-module "*"
```

or add

```
"yii3ds/yii2-start-events-module": "*"
```

to the require section of your `composer.json` file.

Configuration
=============

- Add module to config section:

```
'modules' => [
    'events' => [
        'class' => 'yii3ds\events\Module'
    ]
]
```

- Run migrations:

```
php yii migrate --migrationPath=@yii3ds/events/migrations
```

- Run RBAC command:

```
php yii events/rbac/add
```
