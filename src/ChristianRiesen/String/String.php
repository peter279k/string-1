<?php
namespace ChristianRiesen\String;

class String
{
    /**
     * Actual string content
     * 
     * @var string
     */
    protected $string;
    
    public function __construct($string = null)
    {
        $this->string = $string;
    }
    
    public function set($string = null)
    {
        $this->string = $string;
        
        return $this;
    }

    /* Getter functions*/
    /*******************************************/
    public function get()
    {
        return $this->string;
    }
    
    public function __toString()
    {
        return $this->get();
    }
    
    /* Manipulation functions*/
    /*******************************************/
    public function upper()
    {
        return new self(strtoupper($this->get()));
    }
    
    public function lower()
    {
        return new self(strtolower($this->get()));
    }
    
    public function cut($length)
    {
        if (!is_int($length)) {
            throw new \InvalidArgumentException('Length to cut must be integer');
        }
        
        if ($length <= 0) {
            throw new \InvalidArgumentException('Length must be larger than zero');
        }
        
        return new self(substr($this->get(), 0, $length));
    }
}