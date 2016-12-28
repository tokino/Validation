<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 15:21
 */

namespace Tokino\Validation\Rule;


class InArray extends AbstractRule
{
    private $haystack;
    private $strict;

    /**
     *
     * @param $value
     * @param $haystack
     * @param $strict
     * @param array $options
     */
    public function __construct($value, array $haystack, $strict = false, $options = array())
    {
        $this->setOptions($options);

        $this->setValue($value);
        $this->haystack = $haystack;
        $this->strict = $strict;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function check($value)
    {
        if (!is_array($this->haystack)) {
            return false;
        }

        if (!$this->options['required'] && empty($this->haystack)) {
            return true;
        }

        return in_array($value, $this->haystack, $this->strict);
    }
}