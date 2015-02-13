<?php

namespace yii3ds\events\traits;

use yii3ds\events\Module;

/**
 * Class ModuleTrait
 * @package yii3ds\events\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait
{
    /**
     * @var \yii3ds\events\Module|null Module instance
     */
    private $_module;

    /**
     * @return \yii3ds\events\Module|null Module instance
     */
    public function getModule()
    {
        if ($this->_module === null) {
            $this->_module = Module::getInstance();
        }
        return $this->_module;
    }
}
