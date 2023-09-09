<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

use JakubBoucek\OpenWhisk\Runtime\Source\DynamicSource;

class DynamicResponse implements Response
{
    use HttpHeader;
    use HttpFields;

    private DynamicSource $source;

    public function __construct(DynamicSource $source, int $statusCode = 200, array $headers = [])
    {
        $this->source = $source;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getArrayCopy(): array
    {
        return [
            self::BodyKey => $this->source->getResponse(),
            self::StatusCodeKey => $this->statusCode,
            self::HeadersKey => $this->headers
        ];
    }
}
