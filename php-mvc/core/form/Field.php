<?php

namespace app\core\form;

use app\core\form\BaseField;
use app\core\Model;

/**
 * Class Field
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core\form\BaseField;
 */

class Field extends BaseField {

    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';

    public string $type;

    /**
     * Field constructor
     *
     * @param \app\core\Model $model
     * @param string $attribute
     */
    public function __construct( $model, string $attribute ) {
        $this->type = self::TYPE_TEXT;
        parent::__construct( $model, $attribute );
    }

    public function passwordField() {
        $this->type = self::TYPE_PASSWORD;

        return $this;
    }

    public function renderInput(): string {

        return sprintf( '<input type="%s" name="%s" value="%s" class="form-control %s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError( $this->attribute ) ? 'is-invalid' : '', );
    }
}