<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 11:49
 */

namespace Tokino\Validation;


use Exception;
use Tokino\Validation\Rule\AbstractRule;

/**
 * Class Validator
 * @package Tokino\Validation
 *
 * @method static AbstractRule inArray($value, array $search, $strict = false, $options = array())
 * @method static AbstractRule required($value, $options = array())
 * @method static AbstractRule regex($value, $regex, $options = array())
 * @method static AbstractRule composition(array $value, $options = array())
 * @method static AbstractRule numeric($value, $options = array())
 */
class Validator
{
    private static $rules = array();
    private static $errors = array();
    private static $factory;

    /**
     * @return Factory
     */
    private static function getFactory() {
        if (self::$factory instanceof Factory) {
            return self::$factory;
        }

        self::setFactory(new Factory());

        return self::$factory;
    }

    /**
     * @param Factory $factory
     */
    public static function setFactory(Factory $factory) {
        self::$factory = $factory;
    }

    /**
     * @param $name
     * @param $arguments
     * @return object|AbstractRule
     * @throws Exception
     */
    private static function buildRule($name, $arguments) {
        try {
            return self::getFactory()->rule($name, $arguments);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return object|AbstractRule
     */
    public static function __callStatic($name, $arguments)
    {
        return self::buildRule($name, $arguments);
    }

    /**
     * @param AbstractRule $rule
     */
    public static function addRule(AbstractRule $rule) {
        self::$rules[] = $rule;
    }

    public static function getRules() {
        return self::$rules;
    }

    /**
     * @param array $rules
     */
    public static function addRules(array $rules) {
        foreach ($rules as $rule) {
            self::addRule($rule);
        }
    }

    /**
     * @return bool
     */
    public static function validate() {
        /**
         * @var AbstractRule $rule
         */
        foreach (self::$rules as $rule) {
            if (!$rule->validate()) {
                self::setError($rule->getName(), $rule->getError());
            }
        }

        return !count(self::$errors);
    }

    private static function setError($name, $msg) {
        if (is_null($name)) {
            self::$errors[] = $msg;
        } else {
            self::$errors[$name] = $msg;
        }
    }

    public static function getErrors() {
        return new Error(self::$errors);
    }
}