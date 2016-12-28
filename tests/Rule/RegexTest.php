<?php
/**
 * Created by PhpStorm.
 * User: gooya
 * Date: 16/12/13
 * Time: 18:16
 */


use Tokino\Validation\Rule\Regex;


class RegexTest extends PHPUnit_Framework_TestCase
{
    public function testSuccess() {
        $validation = new Regex('tomohiro.kino@gooya.co.jp', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i');
        $this->assertTrue($validation->validate());
    }

    public function testSuccess2() {
        $validation = new Regex('tomohiro.kino+1@gooya.co.jp', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i');
        $this->assertTrue($validation->validate());
    }

    public function testFailed() {
        $validation = new Regex('tomohiro.kino@', '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i');
        $this->assertFalse($validation->validate());
    }
}
