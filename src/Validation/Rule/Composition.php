<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 17:14
 */

namespace Tokino\Validation\Rule;


class Composition extends AbstractRule
{
    /**
     *
     * @param $rules
     * @param array $options
     */
    public function __construct(array $rules, $options = array())
    {
        $this->setOptions($options);
        $this->setValue($rules);
    }

    protected function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @param $rules
     * @return bool
     */
    protected function check($rules)
    {
        /**
         * @var AbstractRule $rule
         */
        foreach ($rules as $rule) {
            if (!$rule->validate()) {
                return false;
            }
        }

        return true;
    }
}