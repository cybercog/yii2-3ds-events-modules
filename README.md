<<<<<<< HEAD
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
=======
# yii2-3ds-events-modules
this module management events on your website
>>>>>>> 26774311f9a9651075df5a1caa421187cfe3f659
