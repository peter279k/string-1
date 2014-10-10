<?php

use ChristianRiesen\String\String;

class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorBoolean()
    {
        $t = new String(true);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorInteger()
    {
        $t = new String((int) 123);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorFloat()
    {
        $t = new String((float) 1.23);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorArray()
    {
        $t = new String(array(1, 2, 3));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorObject()
    {
        $t = new String(new stdClass());
    }

    public function testSimpleUse()
    {
        $t = new String('The quick brown fox jumps over the lazy gnome.');

        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t);
        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t->get());
    }

    /**
     * @dataProvider getLengthData
     */
    public function testLengths($length, $string)
    {
        $t = new String($string);

        $this->assertEquals($length, $t->length());
    }

    public function getLengthData()
    {
        return array(
            array(4, 'test'),
            array(10, '1234567890'),
            array(0, ''),
        );
    }

    public function testUpper()
    {
        $t = new String('Mary and Alice');
        $upper = $t->upper();

        $this->assertEquals('MARY AND ALICE', (string) $upper);
    }

    public function testLower()
    {
        $t = new String('Mary and Alice');
        $lower = $t->lower();

        $this->assertEquals('mary and alice', (string) $lower);
    }

    public function testCut()
    {
        $t = new String('Test Test Test Test');
        $cut = $t->cut(6);

        $this->assertEquals('Test T', (string) $cut);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCutExceptionSizeZero()
    {
        $t = new String('Test Test Test Test');
        $t->cut(0);
    }
}
