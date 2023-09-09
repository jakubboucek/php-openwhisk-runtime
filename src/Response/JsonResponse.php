<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

class JsonResponse implements Response
{
    use HttpHeader;
    use HttpFields;

    private mixed $data;
    private int $jsonFlags = JSON_THROW_ON_ERROR;

    public function __construct($data, int $statusCode = 200)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->headers = [];

        $this->setContentType(self::JsonContentType);
    }

    public function setJsonFlags($jsonFlags = JSON_THROW_ON_ERROR): self
    {
        $this->jsonFlags = $jsonFlags;

        return $this;
    }

    public function setPrettyJson(bool $pretty = true): self
    {
        $prettyFlags = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

        if ($pretty) {
            $this->jsonFlags |= $prettyFlags;
        } else {
            $this->jsonFlags &= $prettyFlags;
        }

        return $this;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function setData(mixed $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getArrayCopy(): array
    {
        return [
            self::BodyKey => json_encode($this->data, $this->jsonFlags | JSON_THROW_ON_ERROR),
            self::StatusCodeKey => $this->statusCode,
            self::HeadersKey => $this->headers
        ];
    }
}
