<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

use Psr\Http\Message\ResponseInterface;

class Psr7Response implements Response
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getArrayCopy(): array
    {
        return [
            self::BodyKey => (string)$this->response->getBody(),
            self::StatusCodeKey => $this->response->getStatusCode(),
            self::HeadersKey => $this->response->getHeaders()
        ];
    }
}
