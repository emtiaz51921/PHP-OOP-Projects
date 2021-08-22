<?php

namespace app\core\exception;

use Exception;

/**
 * Class Forbidden Exception
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core\exception;
 */

class ForbiddenException extends \Exception {
    protected $message = 'You don\'t have access to this page.';
    protected $code = 403;
}