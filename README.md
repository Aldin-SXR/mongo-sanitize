# mongo-sanitize
[![Build Status](https://travis-ci.com/Aldin-SXR/mongo-sanitize.svg?branch=master)](https://travis-ci.com/Aldin-SXR/mongo-sanitize)

A simple, no-dependency PHP library for defense against [MongoDB query selector injection attacks](https://blog.websecurify.com/2014/08/hacking-nodejs-and-mongodb.html). Inspired by the [homonymous NPM package](https://github.com/vkarpov15/mongo-sanitize) for NodeJS.

## Installation and Usage

The library is available via Composer.

`composer require aldin-sxr/mongo-sanitize`

After installing, include `vendor/autoload.php`  in your project.

```php
<?php

require_once 'vendor/autoload.php';

$data = [
    'hello' => 'world',
    'foo' => [ '$eq' => 'bar' ]
];

$cleaned = mongo_sanitize($data);
// Cleaned array:
// [ 'hello' => 'world, 'foo' => [ ] ]
```

Call `mongo_sanitize()` on the arrays (user input) which you want to sanitize. The function will remove any array elements whose keys start with a `$` (MongoDB operator identifier). The function also works recursively, on embedded array elements.

## Testing

All library methods come with several unit tests in [PHPUnit](https://phpunit.de/), which are available under `tests/unit`.

## License
The library is licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) license. See the [LICENSE](https://github.com/Aldin-SXR/ip-format-tools/blob/master/LICENSE) file for details.
