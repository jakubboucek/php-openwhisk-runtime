<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

trait HttpHeader
{
    public const HtmlContentType = 'text/html';
    public const PlainContentType = 'text/plain';
    public const JsonContentType = 'application/json';

    private const ContentTypeHeader = 'Content-Type';

    abstract public function getHeaders(): array;

    abstract public function setHeaders(array $headers);

    public function getContentType(): ?string
    {
        return $this->getHeaders()[self::ContentTypeHeader] ?? null;
    }

    public function setContentType(?string $value, ?string $charset = 'utf-8'): self
    {
        $contentType = $value . ($charset === null ? '' : '; charset=' . $charset);
        return $this->setHeader(self::ContentTypeHeader, $contentType);
    }

    public function getHeader(string $name): ?string
    {
        return $this->getHeaders()[$name] ?? null;
    }

    public function setHeader(string $name, ?string $value): self
    {
        if ($value === null) {
            return $this->unsetHeader($name);
        }

        $headers = $this->getHeaders();
        $headers[$name] = $value;
        $this->setHeaders($headers);

        return $this;
    }

    public function unsetHeader(string $name): self
    {
        $headers = $this->getHeaders();
        unset($headers[$name]);
        $this->setHeaders($headers);

        return $this;
    }
}
