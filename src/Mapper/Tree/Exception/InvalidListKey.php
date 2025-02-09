<?php

declare(strict_types=1);

namespace CuyZ\Valinor\Mapper\Tree\Exception;

use CuyZ\Valinor\Mapper\Tree\Message\TranslatableMessage;
use CuyZ\Valinor\Utility\String\StringFormatter;
use CuyZ\Valinor\Utility\ValueDumper;
use RuntimeException;

/** @api */
final class InvalidListKey extends RuntimeException implements TranslatableMessage
{
    private string $body = 'Invalid sequential key {key}, expected {expected}.';

    /** @var array<string, string> */
    private array $parameters;

    /**
     * @param int|string $key
     */
    public function __construct($key, int $expected)
    {
        $this->parameters = [
            'key' => ValueDumper::dump($key),
            'expected' => (string)$expected,
        ];

        parent::__construct(StringFormatter::for($this), 1654273010);
    }

    public function body(): string
    {
        return $this->body;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}
