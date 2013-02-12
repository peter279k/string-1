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
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testWrongTypeInSetObject()
    {
        $t = new String('test');
        $t->set(new stdClass());
    }
    
    public function testSimpleUse()
    {
        $t = new String('The quick brown fox jumps over the lazy gnome.');
        
        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t);
        $this->assertEquals('The quick brown fox jumps over the lazy gnome.', $t->get());
        
        $t->set('Lucy with diamonds, you know the rest.');
        
        $this->assertEquals('Lucy with diamonds, you know the rest.', $t);
        $this->assertEquals('Lucy with diamonds, you know the rest.', $t->get());
    }
    
    public function testLengths()
    {
        $t = new String('test');
        
        $this->assertEquals(4, $t->getLength());
        
        $t->set('1234567890');
        
        $this->assertEquals(10, $t->getLength());
        
        $t->set('');
        
        $this->assertEquals(0, $t->getLength());
    }
    
    public function testUpper()
    {
        $t = new String('Mary and Alice');
        $upper = $t->upper();
        
        $this->assertEquals('MARY AND ALICE', $upper);
    }
    
    public function testLower()
    {
        $t = new String('Mary and Alice');
        $lower = $t->lower();
        
        $this->assertEquals('mary and alice', $lower);
    }
    
    public function testCut()
    {
        $t = new String('Test Test Test Test');
        $cut = $t->cut(6);
        
        $this->assertEquals('Test T', $cut);
        
        // Larger than this can be done too, though it SHOULD have no effect
        $cut = $cut->cut(8);
        
        $this->assertEquals('Test T', $cut);
        
        $cut = $cut->cut(1);
        
        $this->assertEquals('T', $cut);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testCutExceptionSizeZero()
    {
        $t = new String('Test Test Test Test');
        $cut = $t->cut(0);
    }
    
    
    
}