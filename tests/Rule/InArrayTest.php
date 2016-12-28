<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 16:12
 */


use Tokino\Validation\Rule\InArray;


class InArrayTest extends PHPUnit_Framework_TestCase
{
    public function testNotStrictSuccess() {
        $validator = new InArray('0', array(0, 1));
        $this->assertTrue($validator->validate());
    }

    public function testNotStrictSFailed() {
        $validator = new InArray('2', array(0, 1));
        $this->assertFalse($validator->validate());
    }

    public function testStrictSuccess() {
        $validator = new InArray(0, array(0, 1), true);
        $this->assertTrue($validator->validate());
    }

    public function testStrictSFailed() {
        $validator = new InArray('0', array(0, 1), true);
        $this->assertFalse($validator->validate());
    }

    public function testRequiredSuccess() {
        $validator = new InArray(0, array(), true, array(
            'required' => false,
        ));
        $this->assertTrue($validator->validate());
    }

    public function testRequiredFailed() {
        $validator = new InArray('0', array(), true, array(
            'required' => true,
        ));

        $this->assertFalse($validator->validate());
    }

    public function testNotStrictNestSuccess() {
        $validator = new InArray(array('test' => '0'), array(0, 1), false, array(
            'name' => 'test',
        ));
        $this->assertTrue($validator->validate());
    }

    public function testNotStrictNestFailed() {
        $validator = new InArray(array('2'), array(0, 1), false, array(
            'name' => 0,
        ));
        $this->assertFalse($validator->validate());
    }

    public function testStrictNestSuccess() {
        $validator = new InArray(array(0), array(0, 1), true, array(
            'name' => 0,
        ));
        $this->assertTrue($validator->validate());
    }

    public function testStrictNestFailed() {
        $validator = new InArray(array('0'), array(0, 1), true, array(
            'name' => 0,
        ));
        $this->assertFalse($validator->validate());
    }

    public function testRequiredNestSuccess() {
        $validator = new InArray(array(0), array(), true, array(
            'required' => false,
            'name' => 0,
        ));
        $this->assertTrue($validator->validate());
    }

    public function testRequiredNestFailed() {
        $validator = new InArray(array('0'), array(), true, array(
            'required' => true,
            'name' => 0,
        ));

        $this->assertFalse($validator->validate());
    }
}
