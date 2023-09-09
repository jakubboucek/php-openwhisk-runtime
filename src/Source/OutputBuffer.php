<?php

declare(strict_types=1);

namespace JakubBoucek\OpenWhisk\Runtime\Source;

use LogicException;

class OutputBuffer implements DynamicSource
{
    private ?string $buffer = null;
    private bool $started = false;

    public function __construct($start = true)
    {
        if ($start) {
            $this->start();
        }
    }

    public function start(): self
    {
        if ($this->started) {
            return $this;
        }

        ob_start();
        $this->started = true;

        return $this;
    }

    public function stop(): self
    {
        if (!$this->started) {
            throw new LogicException(__CLASS__ . ' is not yet started, unable to stop it.');
        }

        $this->buffer = ob_get_clean();
        $this->started = false;

        return $this;
    }

    public function getResponse(): string
    {
        if ($this->started) {
            $this->stop();
        }

        if ($this->buffer === null) {
            throw new LogicException(__CLASS__ . ' is not yet started, unable fetch data.');
        }

        return $this->buffer;
    }
}
