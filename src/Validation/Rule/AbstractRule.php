<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 13:29
 */

namespace Tokino\Validation\Rule;


abstract class AbstractRule
{
    protected $options = array(
        'required' => true,
        'name' => null,
        'message' => '',
    );

    protected $value;

    private $error;

    protected function setOptions(array $options) {
        $this->options = array_merge($this->options, $options);
    }

    public function getName() {
        return $this->options['name'];
    }

    /**
     * @return string
     */
    public function getError() {
        return $this->error;
    }

    /**
     * @param $message
     */
    public function setError($message) {
        $this->error = $message;
    }

    /**
     * @return bool
     */
    private function checkRequire() {
        if (!$this->options['required']) {
            return true;
        }

        $value = $this->getValue();

        if (is_null($value) || $value === '') {
            return false;
        }

        if (is_array($value) && empty($value)) {
            return false;
        }

        return true;
    }

    protected function setValue($value) {

        if (is_null($this->options['name']) || !is_array($value)) {
            $this->value = $value;
        } elseif (isset($value[$this->options['name']])) {
            $this->value = $value[$this->options['name']];
        } else {
            $this->value = null;
        }
    }

    protected function getValue() {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     */
    abstract protected function check($value);

    /**
     * @return bool
     */
    public function validate() {
        if (!$this->checkRequire() || !$this->check($this->getValue())) {
            $this->setError($this->options['message']);
            return false;
        }

        return true;
    }
}