<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/14
 * Time: 11:26
 */

namespace Tokino\Validation;


class Error
{
    private $errors;
    private $format;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function setFormat($format) {
        $this->format = $format;
    }

    public function render($name)
    {
        return isset($this->errors[$name]) ?
            is_null($this->format) ? $this->errors[$name] : sprintf($this->format, $this->errors[$name])
            : null;
    }

    public function hasError() {
        return (bool)count($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}