<?php

namespace app\models;

use app\core\Model;

/**
 * Class Contact Form Model
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\models;
 */

class ContactForm extends Model {

    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $body = '';

    public function rules(): array{
        return [
            'name'  => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED],
            'body'  => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array{
        return [
            'name'    => 'Your Name',
            'email'   => 'Your email',
            'subject' => 'Subject',
            'body'    => 'Your Message',
        ];
    }

    public function send() {
        return true;
    }
}