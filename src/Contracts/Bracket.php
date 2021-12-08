<?php declare(strict_types=1);

namespace Tris\PhpBrackets\Contracts;

use Countable;

interface Bracket extends Countable
{
    /**
     * Check if the opening and closing brackets are balanced
     *
     * @return bool
     */
    public function isBalance(): bool;

    /**
     * Get the length of expression
     *
     * @return int
     */
    public function length(): int;

    /**
     * Get pairing brackets
     *
     * @param string $type
     * @return array
     */
    public function getPairings(string $type = null): array;
}
