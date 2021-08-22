<?php

namespace app\models;

use app\core\UserModel;

/**
 * Class User
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\models;
 */

class User extends UserModel {

    const STATUS_ACTIVATE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_DELETED = 2;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $confirmpassword = '';
    public int $status = self::STATUS_ACTIVATE;

    public static function tableName(): string {
        return 'users';
    }

    public static function primaryKey(): string {
        return 'id';
    }

    public function save() {

        $this->status = self::STATUS_ACTIVATE;
        $this->password = password_hash( $this->password, PASSWORD_DEFAULT );

        return parent::save();
    }

    public function rules(): array{
        return [
            'firstname'       => [self::RULE_REQUIRED],
            'lastname'        => [self::RULE_REQUIRED],
            'email'           => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class,
            ]],
            'password'        => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2], [self::RULE_MAX, 'max' => 20]],
            'confirmpassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    public function labels(): array{
        return [
            'firstname'       => 'First Name',
            'lastname'        => 'Last Name',
            'email'           => 'Email',
            'password'        => 'Password',
            'confirmpassword' => 'Confirm Password',
        ];
    }

    public function getDisplayName(): string {
        return $this->firstname;
    }
}