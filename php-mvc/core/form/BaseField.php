<?php

namespace app\core\form;
use app\core\Model;

/**
 * Class Base Field
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

abstract class BaseField {

    public Model $model;
    public string $attribute;

    public function __construct( $model, string $attribute ) {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString() {
        return sprintf( ' <div class="mb-3">
        <label for="%s" class="form-label">%s</label>
        %s</div>
        <div class="invalid-feedback">%s</div>',
            $this->attribute,
            $this->model->getLabel( $this->attribute ),
            $this->renderInput(),

            $this->model->getFirstError( $this->attribute )
        );
    }
}