<?php
/**
 * Created by PhpStorm.
 * User: kino
 * Date: 2016/12/29
 * Time: 16:41
 */

namespace Tokino\Validation\Rule;


class Email extends AbstractRule
{
    /**
     *
     * @param $value
     * @param array $options
     */
    public function __construct($value, $options = array())
    {
        $this->setOptions($options);
        $this->setValue($value);
    }

    /**
     * @param $value
     * @return bool
     */
    protected function check($value)
    {
        return (bool)filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}