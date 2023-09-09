<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

class RawResponse implements Response
{
    private array $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    public function setResponse(array $response): self
    {
        $this->response = $response;
        return $this;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getArrayCopy(): array
    {
        return $this->response;
    }
}
