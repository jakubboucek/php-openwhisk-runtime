<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

interface Response
{
    public const BodyKey = 'body';
    public const StatusCodeKey = 'statusCode';
    public const HeadersKey = 'headers';

    /**
     * @return array
     *
     * DigitalOceans's PHP runner internally calls this methods on returned response to get array directory.
     * @link https://docs.digitalocean.com/products/functions/reference/parameters-responses/#returns
     */
    public function getArrayCopy(): array;
}
