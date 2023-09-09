<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

trait HttpFields
{
    protected int $statusCode;
    protected array $headers;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }
}
