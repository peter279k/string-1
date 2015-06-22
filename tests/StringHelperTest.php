<?php

namespace ChristianRiesen\StringHelper\Tests;

use ChristianRiesen\StringHelper\StringHelper;

class StringHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorBoolean()
    {
        $t = new StringHelper(true);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorInteger()
    {
        $t = new StringHelper((int) 123);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorFloat()
    {
        $t = new StringHelper((float) 1.23);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorArray()
    {
        $t = new StringHelper(array(1, 2, 3));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInConstructorObject()
    {
        $t = new StringHelper(new \stdClass());
    }

    public function testSimpleUse()
    {
        $t = new StringHelper('The quick brown fox jumps over the lazy gnome.');

        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t);
        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t->get());
    }

    /**
     * @dataProvider getLengthData
     */
    public function testLengths($length, $string)
    {
        $t = new StringHelper($string);

        $this->assertEquals($length, $t->getLength());
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
        $t = new StringHelper('Mary and Alice');
        $upper = $t->upper();

        $this->assertEquals('MARY AND ALICE', (string) $upper);
    }

    public function testLower()
    {
        $t = new StringHelper('Mary and Alice');
        $lower = $t->lower();

        $this->assertEquals('mary and alice', (string) $lower);
    }

    public function testCut()
    {
        $t = new StringHelper('Test Test Test Test');
        $cut = $t->cut(6);

        $this->assertEquals('Test T', (string) $cut);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testCutExceptionSizeZero()
    {
        $t = new StringHelper('Test Test Test Test');
        $t->cut(0);
    }

    /**
     * @dataProvider getWordCountData
     */
    public function testWordCount($length, $string)
    {
        $t = new StringHelper($string);

        $this->assertEquals($length, $t->getWordCount());
    }

    public function getWordCountData()
    {
        return array(
            array(1, 'one'),
            array(2, 'It\'s two'),
            array(3, 'One two three'),
            array(5, 'One two three. And five.'),
        );
    }

    /**
     * @dataProvider getSentencesCountData
     */
    public function testSentencesCount($length, $string)
    {
        $t = new StringHelper($string);

        $this->assertEquals($length, $t->getSentencesCount());
    }

    public function getSentencesCountData()
    {
        return array(
            array(1, 'Only a single sentence.'),
            array(1, 'Still, only one; Sentence.'),
            array(2, 'This is two!? Yes it is.'),
            array(2, 'This is two... sentences.'),
            array(1, '"So this is one sentence", he said.'),
        );
    }
}
