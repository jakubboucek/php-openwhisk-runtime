<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

class HttpResponse implements Response
{
    use HttpHeader;
    use HttpFields;

    private string|array $body;

    public function __construct(array|string $body, int $statusCode = 200, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getBody(): array|string
    {
        return $this->body;
    }

    public function setBody(array|string $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function getArrayCopy(): array
    {
        return [
            self::BodyKey => $this->body,
            self::StatusCodeKey => $this->statusCode,
            self::HeadersKey => $this->headers
        ];
    }
}
