<?php

namespace app\core;

/**
 * Class Model
 *
 * @author Shamim <emtiaz51921@gmail.com>
 * @package app\core;
 */

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public function loadData( $data ) {

        foreach ( $data as $key => $value ) {

            if ( property_exists( $this, $key ) ) {
                $this->{$key}

                = $value;
            }

        }

    }

    /**
     * Abstract class holding rules
     *
     * @return array
     */
    abstract public function rules(): array;

    /**
     * Array for labels equal to attributes
     *
     * @return array
     */
    public function labels(): array{
        return [];
    }

    /**
     * Get attributes label
     *
     * @param array $attributes
     * @return string
     */
    public function getLabel( $attributes ) {
        return $this->labels()[$attributes] ?? $attributes;
    }

    public array $errors = [];

    /**
     * Data validation
     *
     * @return void
     */
    public function validate() {

        foreach ( $this->rules() as $attributes => $rules ) {
            $value = $this->{$attributes};

            foreach ( $rules as $rule ) {
                $ruleName = $rule;

                if ( !is_string( $ruleName ) ) {
                    $ruleName = $rule[0];
                }

                if ( $ruleName === self::RULE_REQUIRED && !$value ) {
                    $this->addErrorForRule( $attributes, self::RULE_REQUIRED );
                }

                if ( $ruleName === self::RULE_EMAIL && !filter_var( $value, FILTER_VALIDATE_EMAIL ) ) {
                    $this->addErrorForRule( $attributes, self::RULE_EMAIL );
                }

                if ( $ruleName === self::RULE_MIN && strlen( $value ) < $rule['min'] ) {
                    $this->addErrorForRule( $attributes, self::RULE_MIN, $rule );
                }

                if ( $ruleName === self::RULE_MAX && strlen( $value ) > $rule['max'] ) {
                    $this->addErrorForRule( $attributes, self::RULE_MAX, $rule );
                }

                if ( $ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']} ) {
                    $rule['match'] = $this->getLabel( $rule['match'] );
                    $this->addErrorForRule( $attributes, self::RULE_MATCH, $rule );
                }

                if ( $ruleName === self::RULE_UNIQUE ) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attributes;
                    $tableName = $className::tableName();

                    $statement = Application::$app->db->prepare( "SELECT * FROM $tableName WHERE $uniqueAttr = :attr" );
                    $statement->bindValue( ":attr", $value );
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ( $record ) {
                        $this->addErrorForRule( $attributes, self::RULE_UNIQUE, ['field' => $this->getLabel( $attributes )] );
                    }

                }

            }

        }

        return empty( $this->errors );

    }

    private function addErrorForRule( string $attributes, string $rule, $params = [] ) {
        $message = $this->errorMessage()[$rule] ?? '';

        foreach ( $params as $key => $value ) {
            $message = str_replace( "{{$key}}", $value, $message );
        }

        $this->errors[$attributes][] = $message;
    }

    public function addError( string $attributes, string $message ) {
        $this->errors[$attributes][] = $message;
    }

    /**
     * Handle error messages
     *
     * @return array
     */
    public function errorMessage(): array{
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL    => 'Need a valid email',
            self::RULE_MIN      => 'Min length of the field must be {min}',
            self::RULE_MAX      => 'Max length of the field must be {max}',
            self::RULE_MATCH    => 'This field must be the same as {match}',
            self::RULE_UNIQUE   => 'Record with this {field} already exists',
        ];
    }

    public function hasError( $attributes ) {

        return $this->errors[$attributes] ?? false;
    }

    public function getFirstError( $attributes ) {

        if ( $this->hasError( $attributes ) ) {
            return $this->errors[$attributes][0];
        }

    }

}