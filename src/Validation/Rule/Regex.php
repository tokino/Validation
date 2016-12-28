<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 17:07
 */

namespace Tokino\Validation\Rule;


class Regex extends AbstractRule
{
    private $regex;

    /**
     *
     * @param $value
     * @param $regex
     * @param array $options
     */
    public function __construct($value, $regex, $options = array())
    {
        $this->setOptions($options);
        $this->setValue($value);

        $this->regex = $regex;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function check($value)
    {
        return (bool)preg_match($this->regex, $value);
    }
}