<?php

namespace app\core;
use app\core\db\DbModel;

/**
 * Class User Model
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

abstract class UserModel extends DbModel {

    abstract public function getDisplayName(): string;

}