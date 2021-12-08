<?php declare(strict_types=1);

namespace Tris\PhpBrackets;

use Tris\PhpBrackets\Contracts\Bracket as ContractsBracket;

class Bracket implements ContractsBracket
{
    /**
     * Brackets expression
     *
     * @var string
     */
    public string $expression = '';

    /**
     * The pairing brackets list
     *
     * @var array
     */
    private array $pairings = [
        'round' => [],
        'curly' => [],
        'square' => [],
    ];

    /**
     * Opening brackets
     *
     * @var array
     */
    private array $openings = ['(', '{', '['];

    /**
     * Create a new instance of bracket class
     *
     * @param string $expression
     */
    public function __construct(string $expression)
    {
        $this->expression = preg_replace('/\s+/', '', $expression);
    }

    /**
     * Get pairing brackets
     *
     * @param string $type
     * @return array
     */
    public function getPairings(string $type = null): array
    {
       if (array_key_exists($type, $this->pairings)) {
           return $this->pairings[$type];
       }

       return $this->pairings;
    }

    /**
     * Check if the opening and closing brackets are balanced
     *
     * @return bool
     */
    public function isBalance(): bool
    {
        $stack = [];

        for ($i = 0; $i < $this->length(); $i++) {
            $exp = $this->expression[$i];

            if (in_array($exp, $this->openings)) {
                array_push($stack, $exp);
                continue;
            }

            if (count($stack) === 0) {
                return false;
            }

            switch ($exp) {
                case ')':
                    if (array_pop($stack) === '(') {
                        array_push($this->pairings['round'], '()');
                    } else {
                        return false;
                    }
                    break;
                case '}':
                    if (array_pop($stack) === '{') {
                        array_push($this->pairings['curly'], '{}');
                    } else {
                        return false;
                    }
                    break;
                case ']':
                    if (array_pop($stack) === '[') {
                        array_push($this->pairings['square'], '[]');
                    } else {
                        return false;
                    }
                    break;
            }
        }
        
        return count($stack) === 0;
    }

    /**
     * Get the length of expression
     *
     * @return int
     */
    public function length(): int
    {
        return strlen($this->expression);
    }

    /**
     * Get the total of pairing brackets
     *
     * @return int
     */
    public function count(): int
    {
        $total = 0;

        foreach ($this->getPairings() as $values) {
            $total += count($values);
        }

        return $total;
    }
}
