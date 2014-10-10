String
======

String handling and manipulation class.

[![Build Status](https://travis-ci.org/ChristianRiesen/string.svg?branch=master)](https://travis-ci.org/ChristianRiesen/string)

Yet another string class
------------------------

Most classes I found out there do a counter intuitive thing, basically working as a static repo for functions like `String::upper('acme')`, to get the work done. When I have to work with strings though I find myself mostly doing multiple operations at once, so using a fluid interface and actual objects makes more sense to me. Based on this, I created this library.

Basic use
---------

The meta functions return info about a string. All other functions manipulate the string and return a new instance with the new content.

This makes it a bit tricky if you have very little memory and work with very big strings, so be aware of this.

A simple echo or casting to string will use the `__toString()` magic function. A simple function called `get()` does the same in case you have a need that can't be covered by the magic function.

```php

use ChristianRiesen\String\String;

$string = new String('acme is A company that makes Everything!');

// Output: acme is A company that makes Everything!
echo $string;

// Output: 
echo $string->upper();

// Output: 
echo $string->lower();

// Output: ACM
echo $string->cut('3')->upper();
echo $string->upper()->cut('3');

```

