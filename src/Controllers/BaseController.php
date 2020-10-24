<?php

namespace Core\Controllers;
use flight\Engine;

abstract class BaseController
{
    /**
     * framework instance
     *
     * @var Engine
     */
    protected $app;

    /**
     * instantiates this controller
     *
     * @param Engine $appInstance
     */
    public function __construct(Engine $appInstance) {
        $this->app = $appInstance;
    }

}
