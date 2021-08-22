<?php

namespace app\core\middlewares;

/**
 * Class Base Middleware
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core\middlewares;
 */

abstract class BaseMiddleware {

    abstract public function execute();
}