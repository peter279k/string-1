<?php

namespace ChristianRiesen\String;

class String
{
    /**
     * Actual string content
     *
     * @var string
     */
    private $string;

    /**
     * Constructor
     *
     * @param string $string Content
     */
    public function __construct($string)
    {
        if (!is_string($string)) {
            throw new \InvalidArgumentException('Expecting string, gotten ' . gettype($string));
        }

        $this->string = $string;
    }

    /**
     * Return content
     *
     * @return string Content
     */
    public function get()
    {
        return $this->string;
    }

    /**
     * Return content
     *
     * @return string Content
     */
    public function __toString()
    {
        return $this->get();
    }

    /*
     * Meta functions
     *
     * Returning meta data about the string
     */

    /**
     * Get string length
     *
     * @return integer Length of string
     */
    public function length()
    {
        return strlen($this->get());
    }

    /**
     * Does string contain another?
     *
     * @param string $needle String to search for in existing string
     *
     * @return bool Does this string contain another?
     */
    public function contains($needle)
    {
        if (strpos($this->string, (string) $needle) !== false) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Manipulation functions
     *
     * These return a new string object with the manipulated content.
     */

    /**
     * Convert everything to upper case
     *
     * @return String
     */
    public function upper()
    {
        return new self(strtoupper($this->get()));
    }

    /**
     * Convert everything to lower case
     *
     * @return String
     */
    public function lower()
    {
        return new self(strtolower($this->get()));
    }

    /**
     * Cut string down to a specific length
     *
     * @param integer $length Maximum length of new string
     *
     * @return String
     */
    public function cut($length)
    {
        if (!is_int($length)) {
            throw new \InvalidArgumentException('Length to cut must be an integer');
        }

        if ($length <= 0) {
            throw new \InvalidArgumentException('Length must be larger than zero');
        }

        if ($this->length() >= $length) {
            // It's already matching
            return $this;
        }

        return new self(substr($this->get(), 0, $length));
    }
}
