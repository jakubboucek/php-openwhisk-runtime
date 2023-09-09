<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

class RawJsonResponse extends RawResponse
{
    public function __construct(array $data)
    {
        parent::__construct([self::BodyKey => $data]);
    }
}
