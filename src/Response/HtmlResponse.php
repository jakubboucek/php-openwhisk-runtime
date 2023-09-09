<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Response;

class HtmlResponse extends HttpResponse
{
    public function __construct(string $body, int $statusCode = 200)
    {
        parent::__construct($body, $statusCode);
        $this->setContentType(self::HtmlContentType);
    }
}
