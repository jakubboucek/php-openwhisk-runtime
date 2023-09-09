<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Source;

interface DynamicSource
{
    public function getResponse(): string|array;
}
