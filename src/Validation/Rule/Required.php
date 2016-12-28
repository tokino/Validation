<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 17:01
 */

namespace Tokino\Validation\Rule;


class Required extends AbstractRule
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
        return true;
    }
}