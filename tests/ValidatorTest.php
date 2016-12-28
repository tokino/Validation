<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 15:52
 */

use Tokino\Validation\Validator;


class ValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testAddRule() {
        $this->assertCount(0, Validator::getRules());
        Validator::addRule(Validator::inArray(0, array(0, 1)));
        $this->assertCount(1, Validator::getRules());
    }

    public function testAddRules() {
        $this->assertCount(1, Validator::getRules());
        Validator::addRules(array(
            Validator::inArray(0, array(0, 1)),
            Validator::inArray(0, array(0, 1))
        ));
        $this->assertCount(3, Validator::getRules());
    }

    public function testValidateSuccess() {
        $this->assertTrue(Validator::validate());
    }

    public function testValidateFailed() {
        Validator::addRule(Validator::inArray(2, array(0, 1)));
        $this->assertFalse(Validator::validate());
    }

    public function testGetErrors() {
        $errors = Validator::getErrors();
        $this->assertEquals('', $errors->render(0));
    }

    public function testValidateNestFailed() {
        Validator::addRule(Validator::inArray(2, array(0, 1), false, array(
            'name' => 'test',
            'message' => 'test error'
        )));
        $this->assertFalse(Validator::validate());
    }

    public function testGetNestErrors() {
        $errors = Validator::getErrors();
        $this->assertEquals('test error', $errors->render('test'));
    }
}
