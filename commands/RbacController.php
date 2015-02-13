<?php

namespace yii3ds\events\commands;

use Yii;
use yii\console\Controller;

/**
 * Events RBAC controller.
 */
class RbacController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'add';

    /**
     * @var array Main module permission array
     */
    public $mainPermission = [
        'name' => 'administrateEvents',
        'description' => 'Can administrate all "Events" module'
    ];

    /**
     * @var array Permission
     */
    public $permissions = [
        'BViewEvents' => [
            'description' => 'Can view backend events list'
        ],
        'BCreateEvents' => [
            'description' => 'Can create backend events'
        ],
        'BUpdateEvents' => [
            'description' => 'Can update backend events'
        ],
        'BDeleteEvents' => [
            'description' => 'Can delete backend events'
        ],
        'viewEvents' => [
            'description' => 'Can view events'
        ],
        'createEvents' => [
            'description' => 'Can create events'
        ],
        'updateEvents' => [
            'description' => 'Can update events'
        ],
        'updateOwnEvents' => [
            'description' => 'Can update own events',
            'rule' => 'author'
        ],
        'deleteEvents' => [
            'description' => 'Can delete events'
        ],
        'deleteOwnEvents' => [
            'description' => 'Can delete own events',
            'rule' => 'author'
        ]
    ];

    /**
     * Add comments RBAC.
     */
    public function actionAdd()
    {
        $auth = Yii::$app->authManager;
        $superadmin = $auth->getRole('superadmin');
        $mainPermission = $auth->createPermission($this->mainPermission['name']);
        if (isset($this->mainPermission['description'])) {
            $mainPermission->description = $this->mainPermission['description'];
        }
        if (isset($this->mainPermission['rule'])) {
            $mainPermission->ruleName = $this->mainPermission['rule'];
        }
        $auth->add($mainPermission);

        foreach ($this->permissions as $name => $option) {
            $permission = $auth->createPermission($name);
            if (isset($option['description'])) {
                $permission->description = $option['description'];
            }
            if (isset($option['rule'])) {
                $permission->ruleName = $option['rule'];
            }
            $auth->add($permission);
            $auth->addChild($mainPermission, $permission);
        }

        $auth->addChild($superadmin, $mainPermission);

        $updateEvents = $auth->getPermission('updateEvents');
        $updateOwnEvents = $auth->getPermission('updateOwnEvents');
        $deleteEvents = $auth->getPermission('deleteEvents');
        $deleteOwnEvents = $auth->getPermission('deleteOwnEvents');

        $auth->addChild($updateEvents, $updateOwnEvents);
        $auth->addChild($deleteEvents, $deleteOwnEvents);

        return static::EXIT_CODE_NORMAL;
    }

    /**
     * Remove comments RBAC.
     */
    public function actionRemove()
    {
        $auth = Yii::$app->authManager;
        $permissions = array_keys($this->permissions);

        foreach ($permissions as $name => $option) {
            $permission = $auth->getPermission($name);
            $auth->remove($permission);
        }

        $mainPermission = $auth->getPermission($this->mainPermission['name']);
        $auth->remove($mainPermission);

        return static::EXIT_CODE_NORMAL;
    }
}
