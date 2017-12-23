<?php

namespace ChristianRiesen\StringHelper;

class StringHelper {
    /**
     * Actual string content.
     *
     * @var string
     */
    private $string;

    /**
     * Constructor.
     *
     * @param string $string Content
     */
    public function __construct($string) {
        if (!\is_string($string)) {
            throw new \InvalidArgumentException('Expecting string, gotten ' . \gettype($string));
        }

        $this->string = $string;
    }

    /**
     * Return content.
     *
     * @return string Content
     */
    public function get() {
        return $this->string;
    }

    /**
     * Return content.
     *
     * @return string Content
     */
    public function __toString() {
        return $this->get();
    }

    /*
     * Meta functions
     *
     * Returning meta data about the string
     */

    /**
     * Get string length.
     *
     * @return integer Length of string
     */
    public function getLength() {
        return \strlen($this->get());
    }

    /**
     * Get word count.
     *
     * @return integer Count of words in string
     */
    public function getWordCount() {
        return \str_word_count($this->get());
    }

    /**
     * Get sentences count.
     *
     * @return integer Count of sentences in string
     */
    public function getSentencesCount() {
        $string = $this->get();

        // Change all endings into dots
        $string = \str_replace(array('!', '?'), '.', $string);

        // Remove non essentials
        $string = \preg_replace('/[^a-zA-Z0-9\.]/', '', $string);

        // Remove multiple sentence endings
        $string = \preg_replace('/\.{2,}/', '.', $string);

        // Count sentence endings
        return \substr_count($string, '.');
    }

    /**
     * Get lines count.
     *
     * @return integer Count of lines string
     */
    public function getLinesCount() {
        return \substr_count($this->get(), PHP_EOL);
    }

    /**
     * Does string contain another?
     *
     * @param string $needle String to search for in existing string
     *
     * @return bool Does this string contain another?
     */
    public function contains($needle) {
        if (\strpos($this->string, (string) $needle) !== false) {
            return true;
        }
        return false;
    }

    /*
     * Manipulation functions
     *
     * These return a new string object with the manipulated content.
     */

    /**
     * Convert everything to upper case.
     *
     * @return StringHelper
     */
    public function upper() {
        return new self(\strtoupper($this->get()));
    }

    /**
     * Convert everything to lower case.
     *
     * @return StringHelper
     */
    public function lower() {
        return new self(\strtolower($this->get()));
    }

    /**
     * Cut string down to a specific length.
     *
     * @param integer $length Maximum length of new string
     *
     * @return StringHelper
     */
    public function cut($length) {
        if (!\is_int($length)) {
            throw new \InvalidArgumentException('Length to cut must be an integer');
        }

        if ($length <= 0) {
            throw new \InvalidArgumentException('Length must be larger than zero');
        }

        if ($length >= $this->getLength()) {
            // It's already matching
            return $this;
        }

        return new self(\substr($this->get(), 0, $length));
    }
}
