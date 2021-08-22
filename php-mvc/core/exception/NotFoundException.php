<?php

namespace app\core\exception;

/**
 * Class Not Found Exception
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core\exception;
 */

class NotFoundException extends \Exception {
    protected $message = 'Page not found!';
    protected $code = 404;
}