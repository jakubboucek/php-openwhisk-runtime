# OpenWhisk runtime tools for PHP

This library provide tools for more clean handling responses for PHP apps running inside
[OpenWhisk runtime](https://github.com/apache/openwhisk-runtime-php/blob/master/README.md).

In [raw OpenWhisk action](https://github.com/apache/openwhisk/blob/master/docs/actions-php.md#creating-and-invoking-php-actions)
you need to return clearly defined Array - that's missing type control and it's liitle dirty.

This library provides tools to build responses for most of usually cases (HTTP, HTML, JSON responses, etc.).

## Install

```shell
composer require jakubboucek/openwhisk-runtime
```

## Usage

### Sending OpenWhisk runtime's response without this library

```php
<?php
function main(array $args) : array
{
    $name = $args['name'] ?? 'stranger';
    $greeting = "Hello $name!";
    return ['body' => $greeting, 'headers' => ['Content-Type' => 'text/html; charset=utf-8']];
}
```

### Raw Response (just only for back compatibility with OpenWhisk's raw)

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
function main(array $args) : array
{
    $name = $args['name'] ?? 'stranger';
    $greeting = "Hello $name!";
    return new Response\RawResponse(['body' => $greeting, 'headers' => ['Content-Type' => 'text/html; charset=utf-8']]);
}
```

### Raw JSON Response (just only for back compatibility with OpenWhisk's raw)

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
function main(array $args) : array
{
    $name = $args['name'] ?? 'stranger';
    $greeting = "Hello $name!";
    return new Response\RawJsonResponse(['message' => $greeting]);
}
```

### HTTP Response

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
function main(array $args) : array
{
    if (!isset($args['name'])) {
        return (new Response\HttpResponse("Error: Missing required field 'name'."))
            ->setStatusCode(400)
            ->setContentType(Response\HttpHeader::PlainContentType);
    }

    $greeting = "Hello {$args['name']}!";
    return (new Response\HttpResponse($greeting))
        ->setContentType(Response\HttpHeader::PlainContentType);
}
```

### HTML Response

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
function main(array $args) : array
{
    $name = $args['name'] ?? 'stranger';
    $greeting = sprintf('Hello <strong>%s</strong>!', htmlspecialchars($name));
    return new Response\HtmlResponse($greeting);
}
```

### JSON Response

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
function main(array $args) : array
{
    if (!isset($args['name'])) {
        return (new Response\JsonResponse(['error' =>"Error: Missing required field 'name'."))
            ->setStatusCode(400);
    }

    $greeting = "Hello {$args['name']}!";
    return new Response\JsonResponse(['message' => $greeting]);
}
```
### Catching standard Output Buffer Response

```php
<?php
use JakubBoucek\OpenWhisk\Runtime\Response;
use JakubBoucek\OpenWhisk\Runtime\Source;
function main(array $args) : array
{
    $response = new Response\DynamicResponse(new Source\OutputBuffer());   

    echo 'Dumping $args variable:' . "\n";
    var_dump($args);   
   
    return $response;
}
```
